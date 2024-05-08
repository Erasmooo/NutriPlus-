<?php
    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $idade = $_POST["idade"];
	$gender = $_POST["gender"];
    $email = $_POST["email"];
    $altura = $_POST["altura"];
    $peso = $_POST["peso"];
    $doencaCronica = $_POST["doencaCronica"];
    $alergia = $_POST["alergia"];
    $circunferenciaBraco = $_POST["circunferenciaBraco"];
    $circunferenciaCintura = $_POST["circunferenciaCintura"];
    //$outroEstado = $_POST["outroEstado"];




    // Database connection
	$conn = new mysqli('localhost','root','','nutri');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into paciente(nome, apelido, idade, gender, email, altura, peso,circunferenciaBraco,circunferenciaCintura, doencaCronica, alergia ) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssissiiddss", $nome, $apelido, $idade, $gender, $email, $altura, $peso, $circunferenciaBraco, $circunferenciaCintura, $doencaCronica, $alergia);
		$execval = $stmt->execute();


		if ($execval) {
            // Registro bem-sucedido, redirecionar para a página listarP.php com uma mensagem de sucesso
            echo "<script>alert('Registro bem-sucedido!'); window.location = 'gpacientes.php';</script>";
        } else {
            // Se houver um problema no registro, exibir mensagem de erro
            echo "Erro no registro: " . $stmt->error;
        }

		$stmt->close();
		$conn->close();
	}
?>

