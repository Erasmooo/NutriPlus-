<?php
	$conn = new mysqli('localhost','root','','nutri');

    if ($mysql->connect_error) {
        die("Conexão falhou: " . $mysql->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];  
        $query = "DELETE FROM `paciente` WHERE id = '$id'";  
        $run = mysqli_query($conn,$query);  
        if ($run) {  
            header('location:gpacientes.php');  

        }else{  
            echo "Error: ".mysqli_error($conn);  
        }  
    }

    $mysql->close();
?>


