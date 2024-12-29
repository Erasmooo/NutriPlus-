<?php
// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obter dados do POST
$hemoglobina = $_POST['hemoglobina'];
$ferritina = $_POST['ferritina'];
$albumina = $_POST['albumina'];
$vitaminaB12 = $_POST['vitaminaB12'];
$vitaminaD = $_POST['vitaminaD'];

// Verificar os dados recebidos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
} else {
    echo json_encode(['error' => 'Método de requisição inválido.']);
    exit;
}

// Criar o arquivo ARFF temporário
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

// Caminho para o arquivo JAR do Weka
$wekaJarPath = 'C:\\Program Files\\Weka-3-8-6\\weka.jar';

// Comando para executar o Weka
$command = 'java -classpath ' . escapeshellarg($wekaJarPath) . ' weka.classifiers.trees.J48 -T ' . escapeshellarg($arffFilePath) . ' -l modelo.model -p 0';

// Executa o comando e captura a saída e o código de retorno
exec($command . ' 2>&1', $output, $return_var);

// Parsear a saída do Weka para obter as classificações
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

// Exibir a saída do Weka
echo json_encode([
    'output' => $output,
    'return_var' => $return_var,
    'classifications' => $classifications
]);

// Remover o arquivo ARFF temporário
unlink($arffFilePath);
?>
