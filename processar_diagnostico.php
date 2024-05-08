<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutri";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$paciente_id = $_POST['paciente'];
$hemoglobina = $_POST['hemoglobina'];
$ferritina = $_POST['ferritina'];
$albumina = $_POST['albumina'];
$vitaminab = $_POST['vitaminab'];
$vitaminad = $_POST['vitaminad'];
$calcio = $_POST['calcio'];
$zinco = $_POST['zinco'];

// Retrieve the patient's name and nickname from the `paciente` table
$consulta = $conn->prepare("SELECT nome, apelido FROM paciente WHERE id = ?");
$consulta->bind_param("i", $paciente_id);
$consulta->execute();
$consulta->bind_result($nome_paciente, $apelido_paciente);
$consulta->fetch();
$consulta->close();

// Check if a patient was found
if (empty($nome_paciente)) {
    die("Erro: Paciente não encontrado");
}

// Use `UPDATE` to modify existing diagnostic data, or `INSERT` if no record exists
$stmt = $conn->prepare("INSERT INTO diagnostio (paciente_id, nome_paciente, apelido_paciente, hemoglobina, ferritina, albumina, vitaminab, vitaminad, calcio, zinco)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
    nome_paciente = VALUES(nome_paciente), apelido_paciente = VALUES(apelido_paciente),
    hemoglobina = VALUES(hemoglobina), ferritina = VALUES(ferritina),
    albumina = VALUES(albumina), vitaminab = VALUES(vitaminab),
    vitaminad = VALUES(vitaminad), calcio = VALUES(calcio), zinco = VALUES(zinco)");

$stmt->bind_param("issddddddd", $paciente_id, $nome_paciente, $apelido_paciente, $hemoglobina, $ferritina, $albumina, $vitaminab, $vitaminad, $calcio, $zinco);

// Execute the statement and check for errors
if ($stmt->execute()) {
            // Registro bem-sucedido, redirecionar para a página listarP.php com uma mensagem de sucesso
            echo "<script>alert('Registro bem-sucedido!'); window.location = 'gdiagnostico.php';</script>";
} else {
    echo "Erro ao salvar diagnostico: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
