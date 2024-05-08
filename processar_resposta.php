<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutri";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $paciente_id = isset($_POST["paciente"]) ? $_POST["paciente"] : null;
   // $resposta = isset($_POST["response"]) ? $_POST["response"] : null;

    // Criar uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Obter o nome do paciente com base no ID
    $consulta_paciente = "SELECT nome FROM paciente WHERE id = $paciente_id";
    $resultado_paciente = $conn->query($consulta_paciente);

    if ($resultado_paciente->num_rows > 0) {
        $row_paciente = $resultado_paciente->fetch_assoc();
        $nome_paciente = $row_paciente['nome'];

        // Inserir dados na tabela "nutricao"
        $inserir_dados = "INSERT INTO nutricao (paciente_id, nome_paciente, response) VALUES ($paciente_id, '$nome_paciente', '$resposta')";

        if ($conn->query($inserir_dados) === TRUE) {
            //echo "Recomendação salva com sucesso!";
            header("Location: listarRec.php");
        } else {
            echo "Erro ao salvar recomendação: " . $conn->error;
        }
    } else {
        echo "Erro ao obter o nome do paciente.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}