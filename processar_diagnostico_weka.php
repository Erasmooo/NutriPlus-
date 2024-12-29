<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutri";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter o ID do paciente da requisição
$paciente_id = $_GET['id'];

// Consultar os dados bioquímicos do paciente
$sql = "SELECT * FROM diagnostio WHERE paciente_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $paciente_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se os dados foram encontrados
if ($result->num_rows > 0) {
    $dados = $result->fetch_assoc();
    echo json_encode($dados);
} else {
    echo json_encode([]);
}

// Fechar a conexão
$conn->close();
?>
