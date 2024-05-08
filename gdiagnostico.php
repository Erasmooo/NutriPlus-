<?php
$mysql = new mysqli("localhost", "root", "", "nutri");


$consulta = "SELECT * FROM diagnostio";
$mysql = $mysql ->query($consulta) or die($mysql -> error); 

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

   <!-- gestao de user section -->

   <section class="department_section layout_padding">
    <div class="department_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Gestão de Diagnosticos
          </h2>
          <p>
            Esta pagina é dedicada a gestão do diagnostico nutricional dos pacientes
          </p>
        </div>
        
        <div class="row justify-content-center">
                       
          <div class="col-md-3 mb-4">
            <a href="adicionarDiagnostico.php">
            <button class="box ">
              <div class="img-box">
                <img src="images/s3.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Adicionar Diagnostico
                </h5>
                <p>
                  fact that a reader will be distracted by the readable page when looking at its layout.
                </p>
              </div>
            </button>
            </a>
          </div>        
        </div>
        
      
        <div class="table-responsive mx-auto" style="max-width: 90%;">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Paciente</th>
                        <th>Nome do Paciente</th>
                        <th>Apelido do Paciente</th>
                        <th>Hemoglobina (g/dL)</th>
                        <th>Ferritina (ng/mL)</th>
                        <th>Albumina (g/dL)</th>
                        <th>Vitamina B12 (pg/mL)</th>
                        <th>Vitamina D (ng/mL)</th>
                        <th>Cálcio (mg/dL)</th>
                        <th>Zinco (µg/dL)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php while($dado = $mysql ->fetch_array()){ ?>
                        <tr>
                            <td><?php echo $dado['id'] ;?></td>
                            <td><?php echo $dado['paciente_id']; ?></td>
                            <td><?php echo $dado['nome_paciente']; ?></td>
                            <td><?php echo $dado['apelido_paciente']; ?></td>
                            <td><?php echo $dado['hemoglobina']; ?></td>
                            <td><?php echo $dado['ferritina']; ?></td>
                            <td><?php echo $dado['albumina']; ?></td>
                            <td><?php echo $dado['vitaminab']; ?></td>
                            <td><?php echo $dado['vitaminad']; ?></td>
                            <td><?php echo $dado['calcio']; ?></td>
                            <td><?php echo $dado['zinco']; ?></td>  
                            <td><a href='actualizarD.php?id=<?php echo $dado["id"]; ?>'  class="btn">Atualizar</a></td>
                            <td><a href='apagarD.php?id=<?php echo $dado["id"]; ?>' class="btnA">Apagar</a></td>
                        </tr>
                    <?php } ?> 
                    </tr>
                    <!-- Adicione mais linhas conforme necessário -->
                </tbody>
            </table>
        </div>    
        
       
      </div>
    </div>
  </section>


  <!-- end recomendation section -->


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