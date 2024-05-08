<?php

    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $idade = $_POST["idade"];
	$gender = $_POST["gender"];
    $email = $_POST["email"];
    $senha = $_POST["senha"]; 
    $telefone = $_POST["telefone"];

    // Database connection
	$conn = new mysqli('localhost','root','','nutri');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into cadastriu(nome, apelido, idade, gender, email, senha, telefone) values(?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssi", $nome, $apelido, $idade, $gender, $email, $senha, $telefone);
		$execval = $stmt->execute();

		if ($execval) {
            // Registro bem-sucedido, redirecionar para a página listarP.php com uma mensagem de sucesso
            echo "<script>alert('Cadastro bem-sucedido!'); window.location = 'login.php';</script>";
        } else {
            // Se houver um problema no registro, exibir mensagem de erro
            echo "Erro no registro: " . $stmt->error;
        }
		$stmt->close();
		$conn->close();
	}
?>

