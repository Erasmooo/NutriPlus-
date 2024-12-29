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
                <a class="nav-link" href="index.html">Início <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> Sobre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gRecomendNutri.html">Recomendação</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="guser.php">Utilizador</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="gpacientes.php">Pacientes</a>
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

  <!-- adicionar paciente section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Adicionar Diagnostico Nutricional 
        </h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="form_container contact-form">
            
          <form action="processar_diagnostico.php" method="post">
          <label for="nome">Nome:</label>
            <select id="paciente" name="paciente" required>
                  <option value="" >Seleccione um paciente</option>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "nutri";
  
              // Criar uma conexão com o banco de dados
              $conn = new mysqli($servername, $username, $password, $dbname);
  
              // Verificar a conexão
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
  
              // Consultar os pacientes no banco de dados
              $consulta = "SELECT id, nome FROM paciente";
              $resultado = $conn->query($consulta);
  
              // Verificar se a consulta retornou resultados
              if ($resultado === false) {
                  die("Erro na consulta: " . $conn->error);
              }
  
              if ($resultado->num_rows > 0) {
                  // Gerar as opções com base nos resultados da consulta
                  while ($row = $resultado->fetch_assoc()) {
                      echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
                  }
              } else {
                  echo '<option value="" disabled>Nenhum paciente encontrado</option>';
              }
  
              // Fechar a conexão com o banco de dados
              $conn->close();
              ?>

              </select><br><br>

            <label for="hemoglobina">Hemoglobina (g/dL):</label>
            <input type="double" id="hemoglobina" name="hemoglobina" required> <br>

            <label for="ferritina">Ferritina (ng/mL):</label>
            <input type="double" id="ferritina" name="ferritina" required> <br>

            <label for="albumina">Albumina (g/dL):</label>
            <input type="double" id="albumina" name="albumina" required> <br>

            <label for="vitaminab">Vitamina B12 (pg/mL):</label>
            <input type="double" id="vitaminab" name="vitaminab" required> <br>

            <label for="vitaminad">Vitamina D (ng/mL):</label>
            <input type="double" id="vitaminad" name="vitaminad" required> <br>
            
            <label for="calcio">Cálcio (mg/dL):</label>
            <input type="double" id="calcio" name="calcio" required> <br>

            <label for="zinco">Zinco (µg/dL):</label>
            <input type="double" id="zinco" name="zinco" required> <br>

            <!-- <label for="acidof">Ácido Fólico:</label>
            <input type="double" id="doenca_cronica" name="doencaCronica"> <br>

            <label for="alergia">Proteína C-Reativa:</label>
            <input type="double" id="alergia" name="alergia"> <br>

            <label for="alergia">Glicose:</label>
            <input type="double" id="alergia" name="alergia"> <br>

            <label for="alergia">Proteína Lipídios:</label>
            <input type="double" id="alergia" name="alergia"> <br>

            <label for="alergia">Creatinina e Ureia:</label>
            <input type="double" id="alergia" name="alergia"> <br> -->
            
            <button type="submit" class="btn" style="background-color: #62d2a2;">Registrar</button>
        </form>

          </div>
        </div>
      </div>
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
              Fale conosco..
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
              Sobre
            </h4>
            <p>
              Nutri+ é um sistema de recomendação nutricional online com base em inteligencia artificial, 
              que usa inteligencia artificial para criar planos alimentares unico e precisos para diminuir 
              o tempo de recuperação dos pacientes.
              
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
                Inicio
              </a>
              <a class="active" href="about.html">
                About
              </a>
              <a class="" href="gRecomendNutri.html">
                Recomendação
              </a>
              <a class="" href="gpacientes.php">
                Pacientes
              </a>
              <a class="" href="contact.html">
                Contacte-nos
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer_col ">
          <h4>
            Quer receber noticias?
          </h4>
          <form action="#">
            <input type="email" placeholder="Insira e-mail" />
            <button type="submit">
              Subscreva
            </button>
          </form>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> Nutri+ 
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