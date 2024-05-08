<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutri";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inicializa variáveis para armazenar os dados do paciente
$nome = $apelido = $idade = $gender = $email = $altura = $peso = $circunferenciaBraco = $circunferenciaCintura = $doencaCronica = $alergia = '';

// Verifica se o ID do paciente foi fornecido na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nome = $_POST["nome"];
        $apelido = $_POST["apelido"];
        $idade = $_POST["idade"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $altura = $_POST["altura"];
        $peso = $_POST["peso"];
        $circunferenciaBraco = $_POST["circunferenciaBraco"];
        $circunferenciaCintura = $_POST["circunferenciaCintura"];
        $doencaCronica = $_POST["doencaCronica"];
        $alergia = $_POST["alergia"];

        // Atualiza os dados do paciente no banco de dados
        $stmt = $conn->prepare("UPDATE paciente SET nome=?, apelido=?, idade=?, gender=?, email=?, altura=?, peso=?, circunferenciaBraco=?, circunferenciaCintura=?, doencaCronica=?, alergia=? WHERE id=?");
        $stmt->bind_param("ssissiiddssi", $nome, $apelido, $idade, $gender, $email, $altura, $peso, $circunferenciaBraco, $circunferenciaCintura, $doencaCronica, $alergia, $id);
    
        // Executa a atualização
        $result = $stmt->execute();

        // Verifica se a atualização foi bem-sucedida
        if ($result) {
            echo "Atualização bem-sucedida.";
        } else {
            echo "Erro na atualização: " . $stmt->error;
        }

        // Fecha a consulta
        $stmt->close();
    }

    // Consulta o banco de dados para obter os dados atualizados do paciente
    $stmt = $conn->prepare("SELECT * FROM paciente WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o paciente existe
    if ($result->num_rows > 0) {
        $paciente = $result->fetch_assoc();

        // Atribui os valores às variáveis
        $nome = $paciente['nome'];
        $apelido = $paciente['apelido'];
        $idade = $paciente['idade'];
        $gender = $paciente['gender'];
        $email = $paciente['email'];
        $altura = $paciente['altura'];
        $peso = $paciente['peso'];
        $circunferenciaBraco = $paciente['circunferenciaBraco'];
        $circunferenciaCintura = $paciente['circunferenciaCintura'];
        $doencaCronica = $paciente['doencaCronica'];
        $alergia = $paciente['alergia'];
    } else {
        echo "Paciente não encontrado.";
    }

    // Fecha a consulta
    $stmt->close();
} else {
    echo "ID de paciente não fornecido.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa os dados do formulário e realiza a atualização no banco de dados

    // ... (Código de processamento da atualização)

    // Redireciona para listarP.php após a atualização
    header("Location: gpacientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Nutri+ </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
       <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
            Nutri+
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> Sobre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gRecomendNutri.html">Recomendação</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="guser.php">Usuarios</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="gpacientes.pgp">Pacientes</a>
             </li>
             <!--
              <li class="nav-item">
                <a class="nav-link" href="departments.html">Departments</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="doctors.html">Doctors</a>
              </li>
            -->
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contacte-nos</a>
              </li>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- Actualizar paciente section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Actualizar Paciente
        </h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="form_container contact-form">
            
          <form  method="post">
            <!-- Os campos do formulário com os valores do paciente -->
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required> <br>

            <label for="apelido">Apelido:</label>
            <input type="text" id="apelido" name="apelido" value="<?php echo $apelido; ?>" required> <br>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" value="<?php echo $idade; ?>" required> <br>

            <div class="radio-buttons">
                <label for="gender">Gênero: </label>
                <div>
                  <label for="male" class="radio-inline">
                      <input type="radio" name="gender" value="m" id="male" <?php echo ($gender == 'm') ? 'checked' : ''; ?> required>Masculino
                  </label>
                  <label for="female" class="radio-inline">
                      <input type="radio" name="gender" value="f" id="female" <?php echo ($gender == 'f') ? 'checked' : ''; ?> required>Feminino
                  </label>
                </div>
            </div>    

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required> <br>

            <label for="altura">Altura:</label>
            <input type="number" id="altura" name="altura" value="<?php echo $altura; ?>" required> <br>

            <label for="peso">Peso:</label>
            <input type="number" id="peso" name="peso" value="<?php echo $peso; ?>" required> <br>

            <label for="circunferenciaBraco">Circunferência do Braço:</label>
            <input type="double" id="circunferenciaBraco" name="circunferenciaBraco" value="<?php echo $circunferenciaBraco; ?>" required> <br>

            <label for="circunferenciCintura">Circunferência da Cintura:</label>
            <input type="double" id="circunferenciaCintura" name="circunferenciaCintura" value="<?php echo $circunferenciaCintura; ?>" required> <br>

            <label for="doenca_cronica">Doença Crônica:</label>
            <input type="text" id="doenca_cronica" name="doencaCronica" value="<?php echo $doencaCronica; ?>"> <br>

            <label for="alergia">Alergia:</label>
            <input type="text" id="alergia" name="alergia" value="<?php echo $alergia; ?>"> <br>

            <button type="submit" class="btn" style="background-color: #62d2a2;">Atualizar</button>
        </form>

          </div>
  </section>
  <!-- end contact section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="footer_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Beatae provident nobis mollitia magnam voluptatum, unde dicta facilis minima veniam corporis laudantium alias tenetur eveniet illum reprehenderit fugit a delectus officiis blanditiis ea.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto footer_col">
          <div class="footer_link_box">
            <h4>
              Links
            </h4>
            <div class="footer_links">
              <a class="" href="index.html">
                Home
              </a>
              <a class="" href="about.html">
                About
              </a>
              <a class="" href="departments.html">
                Departments
              </a>
              <a class="" href="doctors.html">
                Doctors
              </a>
              <a class="active" href="contact.html">
                Contact Us
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col ">
          <h4>
            Newsletter
          </h4>
          <form action="#">
            <input type="email" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates<br><br></a>
            &copy; <span id="displayYear"></span> Distributed By
            <a href="https://themewagon.com/">ThemeWagon</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>