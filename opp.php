<?php
$mysql = new mysqli("localhost", "root", "", "nutri");


$consulta = "SELECT * FROM paciente";
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

  <style>
    .dados-container {
      display: flex;
      flex-direction: row;
      border: 2px solid #62d2a2;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .metricas, .diagnostico {
      flex: 1;
      padding: 1rem;
      margin-right: 1rem;
    }

    .metricas {
      border-right: 2px solid #62d2a2;
    }

    .diagnostico {
      margin-right: 0;
    }

    .metricas h3, .diagnostico h3 {
      font-weight: 700;
      color: #62d2a2;
      margin-bottom: 1rem;
    }

    .metricas ul, .diagnostico ul {
      list-style-type: none;
      padding: 0;
    }

    .metricas li, .diagnostico li {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .metricas input, .diagnostico input {
      flex: 1;
      margin-left: 0.5rem;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
      box-shadow: inset 0px 2px 4px rgba(0, 0, 0, 0.1);
      cursor: not-allowed;
    }

    .metricas input:focus, .diagnostico input:focus {
      outline: none;
      border-color: #62d2a2;
    }
  </style>

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

  <!-- nova Recomendacao nutricional section -->
  
  <section class="department_section layout_padding">
    <div class="department_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Nova Recomendação Nutricional
          </h2>
          <p>
            Esta pagina é dedicada ao pedido de nova Recomendação nutricional
          </p>
          

          <form id="biomarkerForm" action='https://2fbe-41-220-201-128.ngrok-free.app' method="POST" style="margin-top: 2rem;">
              <label for="paciente">Selecione o Paciente:</label>
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

              <!-- Divisões Internas para Dados -->
            <div class="dados-container" style="display: flex; flex-direction: row; border: 1px solid black; padding: 1rem;">
                <!-- Divisão das Métricas -->
                <div class="metricas" style="flex: 1; border-right: 1px solid black; padding-right: 1rem;">
                    <h3>Métricas</h3>
                    <ul>
                        <li>IMC: <input type="text" id="imc" readonly></li>
                        <li>PB: <input type="text" id="cirnferenciaBraco" readonly></li>
                        <li>IMC/Altura: <input type="text" id="imc_altura" readonly></li>
                        <li>Circunferência da Cintura: <input type="text" id="circunferenciaCintura" readonly></li>
                    </ul>
                </div>
                
                <script>
                document.getElementById("paciente").addEventListener("change", function () {
                  const id = this.value;
                  if (id) {
                    fetch(`obter_metrica.php?id=${id}`)
                      .then(response => response.json())
                      .then(dados => {
                        if (dados.id) {
                          document.getElementById("imc").value = dados.imc || "";
                          document.getElementById("cirnferenciaBraco").value = dados.cirnferenciaBraco || "";
                          document.getElementById("imc_altura").value = dados.imca || "";
                          document.getElementById("circunferenciaCintura").value = dados.circunferenciaCintura || "";
                        } else {
                          ["id", "nome", "pb", "imca", "circunferenciaCintura","imc","circunferenciaBraco", "gender"].forEach(id => {
                            document.getElementById(id).value = "";
                          });
                        }
                      })
                      .catch(error => console.error('Erro ao buscar paciente:', error));
                  }
                });
              </script>
                
                <!-- Divisão dos Dados de Diagnóstico -->
                <div class="diagnostico" style="flex: 1; padding-left: 1rem;">
                    <h3>Dados do Diagnóstico</h3>
                    <ul>
                    <li>ID do Paciente: <input type="text" id="paciente_id" readonly></li>
                        <li>Nome do Paciente: <input type="text" id="nome_paciente" readonly></li>
                        <li>Apelido do Paciente: <input type="text" id="apelido_paciente" readonly></li>
                        <li>Hemoglobina: <input type="text" id="hemoglobina"  name="hemoglobina" readonly></li>
                        <li>Ferritina: <input type="text" id="ferritina" name="ferritina" readonly></li>
                        <li>Albumina: <input type="text" id="albumina" name="albumina" readonly></li>
                        <li>Vitamina B12: <input type="text" id="vitamina_b12" name="vitaminab_b12" readonly></li>
                        <li>Vitamina D: <input type="text" id="vitamina_d" name="vitamina_d" readonly></li>
                        <li>Cálcio: <input type="text" id="calcio" name="calcio" readonly></li>
                        <li>Zinco: <input type="text" id="zinco" name="zinco" readonly></li>
                    </ul>

                    <script>
                          document.getElementById("paciente").addEventListener("change", function () {
                              const pacienteId = this.value;
                              if (pacienteId) {
                                  // Faz uma requisição para obter os dados do diagnóstico
                                  fetch(`obter_diagnostico.php?id=${pacienteId}`)
                                      .then(response => response.json())
                                      .then(dados => {
                                          // Preenche os campos de diagnóstico se houver dados
                                          if (dados.paciente_id) {
                                              document.getElementById("paciente_id").value = dados.paciente_id || "";
                                              document.getElementById("nome_paciente").value = dados.nome_paciente || "";
                                              document.getElementById("apelido_paciente").value = dados.apelido_paciente || "";
                                              document.getElementById("hemoglobina").value = dados.hemoglobina || "";
                                              document.getElementById("ferritina").value = dados.ferritina || "";
                                              document.getElementById("albumina").value = dados.albumina || "";
                                              document.getElementById("vitamina_b12").value = dados.vitaminab || "";
                                              document.getElementById("vitamina_d").value = dados.vitaminad || "";
                                              document.getElementById("calcio").value = dados.calcio || "";
                                              document.getElementById("zinco").value = dados.zinco || "";
                                              

                                          } else {
                                              // Limpa os campos se não houver dados
                                              ["paciente_id", "nome_paciente", "apelido_paciente", "hemoglobina", "ferritina", "albumina", "vitaminab", "vitaminad", "calcio", "zinco"].forEach(id => {
                                                  document.getElementById(id).value = "";
                                              });
                                          }
                                      })
                                      .catch(error => console.error('Erro ao buscar diagnóstico:', error));
                              }
                          });
                   </script>
                </div>
            </div><br>
              <div style="display: flex;  align-items:center; justify-content: center; gap:5rem;">
                <div style="">
                  <label for="mytext">---------------------------------------------------------------------------------------------------------------------------------</label><br>
                   
                  <button type="submit" onclick="submitForm()" class="btn" style="background-color: #62d2a2;">Enviar Pedido</button>     
                  
          </form>
                
                <form action="processar_resposta.php" id="resposta"  method="POST">
                  <input id="paciente2" name="paciente" type="hidden" required>
                  <div style="margin-top: 2rem;">
                    <h2>Recomendacao:</h2>
                    
                    <textarea type="text" id="response" name="response" rows="20"  style="width: 100%;" readonly></textarea><br>
                    <button type="submit" class="btn" style="background-color: #62d2a2;">Guardar Recomendacao</button>
                  </div>
              </form>  
            <div>
         
          <div>
        </div>
      </div>
  
      <script>
          const paciente1 = document.querySelector("#paciente");
          const paciente2 = document.querySelector("#paciente2");
          paciente1.addEventListener("change", e => {
              paciente2.value = paciente1.value;
          });
      </script>
    <!--      <script>
            document.getElementById('chat-form').addEventListener('submit', function(e) {
              e.preventDefault();
              const formData = new FormData(this);
              fetch('http://127.0.0.1:8081/predict', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                if (data.status === 'success') {
                  document.getElementById('response').value = JSON.stringify(data.resultados, null, 2);
                } else {
                  document.getElementById('response').value = 'Erro: ' + data.message;
                }
              })
              .catch(error => {
                console.error('Erro ao processar os dados:', error);
                document.getElementById('response').value = 'Erro ao processar os dados. Veja o console para mais detalhes.';
              });
            });
          </script> -->

          <!-- <script>
        function submitForm() {
            console.log('Form submitted');  
            const formData = new FormData(document.getElementById('biomarkerForm'));
            console.log(formData);
            const data = {};
            formData.forEach((value, key) => { data[key] = value });

            fetch('https://3ac7-41-220-201-56.ngrok-free.app', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                const recommendationsDiv = document.getElementById('recommendations');
                recommendationsDiv.innerHTML = '';
                data.forEach(rec => {
                    recommendationsDiv.innerHTML += `<p>Para ${rec.biomarker} (${rec.classification}): ${rec.foods.join(', ')}</p>`;
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script> -->
    <!-- <script>
document.getElementById('biomarkerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);
    const data = {};
    
    // Convert FormData to JSON
    formData.forEach((value, key) => {
        data[key] = value;
    });

    // Send JSON data using fetch
    fetch(this.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        const recommendationsDiv = document.getElementById('recommendations');
        recommendationsDiv.innerHTML = '';
        data.forEach(rec => {
            recommendationsDiv.innerHTML += `<p>Para ${rec.biomarker} (${rec.classification}): ${rec.foods.join(', ')}</p>`;
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script> -->


<script>
    function submitForm() {
        const formData = new FormData(document.getElementById('biomarkerForm'));
        const data = {};

        formData.forEach((value, key) => { data[key] = value });

        fetch('https://2fbe-41-220-201-128.ngrok-free.app', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            const responseTextArea = document.getElementById('response');
            responseTextArea.value = '';
            if (data.error) {
                responseTextArea.value = `Error: ${data.error}`;
            } else {
                data.recommendation.forEach(rec => {
                    responseTextArea.value += `${rec}\n`;
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('response').value = 'Erro ao processar os dados. Veja o console para mais detalhes.';
        });
    }
  </script>

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