<?php
    require_once 'auth.php';
    require_once 'databaseconf.php';

    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM account WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

  <head>
    <meta charset="utf-8">
    <title>Accedi | Azienda Ospedaliera di Giarre</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap|https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href= "mhw3.css">
    <script src="profilo.js" defer="true"></script>  
  </head>

    <body id="profiloutente">
    <header>
        <h1>
          <strong>Il tuo profilo</strong>
        </h1>
      
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
          <?php if (!checkAuth()) { echo '<a class="effetto" href="signup.php">Iscriviti</a>';} ?>
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
        
    <section id="profilo">
        <div class="profile">
      <img src='profilo.png' />
      <span class="utente"> <?php echo $userinfo['name']; ?></span>
      <span class="indirizzo">Email: <?php echo $userinfo['email']; ?></span>
    </div>
    </section>

    <section id = "preferiti">
      <div class="titolo">
        <h1>Reparti Preferiti</h1>
      </div>
      <div class="details"></div>      
      <div class="altrireparti">  
        <div class="details"></div>
      </div>  
    </section>

    <section id="">
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