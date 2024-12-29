<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutri";

// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paciente_id = $_POST["paciente"] ?? null;
    $hemoglobina = $_POST["hemoglobina"] ?? null;
    $ferritina = $_POST["ferritina"] ?? null;
    $albumina = $_POST["albumina"] ?? null;
    $vitaminaB12 = $_POST["vitaminaB12"] ?? null;
    $vitaminaD = $_POST["vitaminaD"] ?? null;
    $calcio = $_POST["calcio"] ?? null;
    $zinco = $_POST["zinco"] ?? null;

    if (!$paciente_id || !$hemoglobina || !$ferritina || !$albumina || !$vitaminaB12 || !$vitaminaD) {
        $response['message'] = 'Todos os campos são obrigatórios.';
        echo json_encode($response);
        exit;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $response['message'] = "Connection failed: " . $conn->connect_error;
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT nome FROM paciente WHERE id = ?");
    $stmt->bind_param("i", $paciente_id);
    $stmt->execute();
    $resultado_paciente = $stmt->get_result();

    if ($resultado_paciente->num_rows > 0) {
        $row_paciente = $resultado_paciente->fetch_assoc();
        $nome_paciente = $row_paciente['nome'];

        // Geração do conteúdo ARFF
        $arffContent = "
@relation bioquimicos

@attribute Hemoglobina real
@attribute Ferritina real
@attribute Albumina real
@attribute Vitamina_B12 real
@attribute Vitamina_D real
@attribute ClassHemoglobina {baixo,normal,alto}
@attribute ClassFerritina {baixo,normal,alto}
@attribute ClassAlbumina {baixo,normal,alto}
@attribute ClassVitamina_B12 {baixo,normal,alto}
@attribute ClassVitamina_D {baixo,normal,alto}

@data
$hemoglobina,$ferritina,$albumina,$vitaminaB12,$vitaminaD,?,?,?,?,?
";

        $arffFilePath = tempnam(sys_get_temp_dir(), 'weka') . '.arff';
        file_put_contents($arffFilePath, $arffContent);

        $wekaJarPath = 'C:\\Program Files\\Weka-3-8-6\\weka.jar';
        $command = 'java -classpath ' . escapeshellarg($wekaJarPath) . ' weka.classifiers.trees.J48 -T ' . escapeshellarg($arffFilePath) . ' -l modelo.model -p 0';

        exec($command . ' 2>&1', $output, $return_var);

        if ($return_var !== 0) {
            $response['message'] = 'Erro ao executar o Weka: ' . implode("\n", $output);
            echo json_encode($response);
            unlink($arffFilePath);
            exit;
        }

        $classifications = [
            'ClassHemoglobina' => 'Desconhecido',
            'ClassFerritina' => 'Desconhecido',
            'ClassAlbumina' => 'Desconhecido',
            'ClassVitamina_B12' => 'Desconhecido',
            'ClassVitamina_D' => 'Desconhecido'
        ];

        foreach ($output as $line) {
            if (preg_match('/(\d+)\s+(\?\s+){5}(\w+),(\w+),(\w+),(\w+),(\w+)/', $line, $matches)) {
                $classifications['ClassHemoglobina'] = $matches[3];
                $classifications['ClassFerritina'] = $matches[4];
                $classifications['ClassAlbumina'] = $matches[5];
                $classifications['ClassVitamina_B12'] = $matches[6];
                $classifications['ClassVitamina_D'] = $matches[7];
                break;
            }
        }

        unlink($arffFilePath);

        $responseText = "Hemoglobina: " . $classifications['ClassHemoglobina'] . "\n" .
                        "Ferritina: " . $classifications['ClassFerritina'] . "\n" .
                        "Albumina: " . $classifications['ClassAlbumina'] . "\n" .
                        "Vitamina B12: " . $classifications['ClassVitamina_B12'] . "\n" .
                        "Vitamina D: " . $classifications['ClassVitamina_D'];

        $stmt_insert = $conn->prepare("INSERT INTO nutricao (paciente_id, nome_paciente, hemoglobina, ferritina, albumina, vitaminaB12, vitaminaD, calcio, zinco, ClassHemoglobina, ClassFerritina, ClassAlbumina, ClassVitamina_B12, ClassVitamina_D) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("isssssssssssss", $paciente_id, $nome_paciente, $hemoglobina, $ferritina, $albumina, $vitaminaB12, $vitaminaD, $calcio, $zinco, $classifications['ClassHemoglobina'], $classifications['ClassFerritina'], $classifications['ClassAlbumina'], $classifications['ClassVitamina_B12'], $classifications['ClassVitamina_D']);

        if ($stmt_insert->execute()) {
            $response['status'] = 'success';
            $response['message'] = $responseText;
        } else {
            $response['message'] = "Erro ao salvar recomendação: " . $stmt_insert->error;
        }
    } else {
        $response['message'] = "Erro ao obter o nome do paciente.";
    }

    $conn->close();
} else {
    $response['message'] = "Nenhum dado recebido.";
}

echo json_encode($response);
?>
