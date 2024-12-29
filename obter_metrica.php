<?php
// obter_diagnostico.php
// Recebe o id do paciente via método GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nutri";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consulta o diagnóstico do paciente
    $consulta = $conn->prepare("SELECT * FROM paciente WHERE id = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();
    $resultado = $consulta->get_result();



    // Verifica se o diagnóstico foi encontrado
    if ($resultado->num_rows > 0) {
        $paciente = $resultado->fetch_assoc();
        echo json_encode($paciente);
    } else {
        echo json_encode([]);
    }



    // Fecha a consulta e a conexão
    $consulta->close();
    $conn->close();
} else {
    echo json_encode([]);
}
