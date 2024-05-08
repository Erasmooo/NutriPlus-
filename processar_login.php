<?php

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "nutri"; 


        $mysqli = new mysqli($servername, $username, $password, $dbname);

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM cadastriu WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;
        



        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index.html");

        } else { ?>
            <div class="alert alert-danger"><h3 class="blink_text">Acesso Negado</h3></div> <?php
            
            //echo "<script>alert('Falhou!'); windows.location='login.html'</script>";
            // echo '<script type="text/javascript">';
            // echo 'alert("Usuário ou senha incorretos!");';
            // echo 'window.location.href = "login.html";'; // Redireciona de volta para a página de login
            // echo '</script>';
        }

    }

}
?>
