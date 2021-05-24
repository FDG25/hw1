<?php
    require_once 'auth.php';
    require_once 'databaseconf.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>News | Azienda Ospedaliera di Giarre</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap|https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href= "mhw3.css">
    <script src="contents.js" defer="true"></script> 
    <script src="scriptnews.js" defer="true"></script>  
  </head>

  <body id = "news">
    <header>
        <h1>
          <strong>Ultime notizie</strong>
        </h1>
        <div id="overlay"></div>
      
      <nav>  
        <div id="contattaci">
          <a href="contattaci.php">Contattaci</a>
        </div>

        <div id="links">
          <a class="effetto" href="mhw3.php">Home</a>  
          <a class="effetto">Chi siamo</a>
          <a class="effetto" href="news.php">News</a>
          <a class="effetto" href="servizi.php">Servizi</a>
          <a class="effetto">Reparti</a>
          <!--<a class="effetto">Dona</a>-->
          <?php if (!checkAuth()) { echo '<a class="effetto" href="login.php">Accedi / Iscriviti</a>';} ?>
          <?php if (checkAuth()) { echo '<a class="effetto" href="profilo.php">Profilo</a>';} ?>
          <?php if (checkAuth()) { echo '<a class="effetto" href="logout.php">Logout</a>';} ?>
        </div>

        <div id="pulsante">  
        <a>Menu</a>
        </div>

	  	  <div id="menu">   
          <div></div>  
          <div></div>  
          <div></div>
        </div>
      </nav>
    </header>


    <section id="novita">
      <div class="titolo">
        <h1>Novità in ambito sanitario</h1>
      </div>
      <div class="container">
        <div class="containerinterno">
            
        </div>
      </div>
    </section>  

    <!--<section id="covidupdate">
        <div class="titolo">
          <h1>Dati del giorno - Coronavirus Sicilia</h1>
        </div>

        <div class="statistiche">
        </div>
    </section>  -->

    <section id="coviditaliaupdate">
      <div class="titolo">
        <h1>Dati del giorno - Coronavirus Italia</h1>
      </div>

      <div class="statistiche">
      </div>
    </section>

    <section id="vacciniupdate">
      <div class="titolo">
        <h1>Dati vaccinazione Anti Covid-19 Sicilia</h1>
      </div>

      <div class= "statistiche">
      </div>
    </section>

        <footer>    
            <p id="trovaci">Find us on:</p>
            <div class="icone">
              <a>         
                <img src="facebook.png"/>
              </a>
              <a>
                <img src="instagram.png"/>
              </a>
              <a>
                <img src="youtube.png"/>
              </a>
            </div>
          <address>   
            <a href="mailto:O46002089@studium.unict.it">Freni Davide Giovanni (O46002089).</a> 
          </address>
            <p id= "lineaconclusiva">© Copyright 2021 - Azienda Ospedaliera di Giarre</p>  
        </footer>
      </body>
    </html>