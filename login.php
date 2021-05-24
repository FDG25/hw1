<?php
    // Verifica che l'utente sia già loggato, in caso positivo va direttamente alla home
    require_once 'auth.php';
    require_once 'databaseconf.php';

    if (checkAuth()) {
        header('Location: mhw3.php');
        exit;
    }

    if (isset($_POST["email"]) && isset($_POST["password"])) {           // Se username e password sono stati inviati
        $error1 = array();

        // Connessione al DB
        $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // ID e Email per sessione, password per controllo
        $query = "SELECT id, email, password FROM account WHERE email = '$email'";
        // Esecuzione
        $res1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_num_rows($res1) > 0) {
            // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno --> l'email è univoca, quindi avremo al più un risultato
            $entry = mysqli_fetch_assoc($res1);  //Fetch a result row as an associative array
            if (password_verify($_POST['password'], $entry['password'])) {  //confrontiamo la password digitata dall'utente con la password associata all'email

                // Imposto una sessione dell'utente (NON UTILIZZIAMO I COOKIE)
                $_SESSION["_ospedale_email"] = $entry['email'];
                $_SESSION["_ospedale_user_id"] = $entry['id'];
                mysqli_free_result($res1);
                mysqli_close($conn);
                header("Location: mhw3.php");//REINDIRIZZIAMO L'UTENTE ALLA HOME DOPO CHE HA EFFETTUATO L'ACCESSO
                exit;
            }
            else {
              // Se l'email non è stata trovata o la password non ha passato la verifica
              $error1 = "Indirizzo email e/o password errati.";
              mysqli_free_result($res1);
              mysqli_close($conn);
          }
        }
    }
    else if (isset($_POST["email"]) && !isset($_POST["password"]) || !isset($_POST["email"]) && isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error1 = "Inserisci indirizzo email e password!";
    }
?>

<html>
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
    <script src="login.js" defer="true"></script> 
  </head>

    <body class = "iscrizione">
    <header>
        <h1>
          <strong>Accedi</strong>
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
        
    <section id="login">
            <div class="contenitoretitolo">
              <h2>Effettua l'accesso</h2>
              <p>Inserisci indirizzo email e password.</p>
            </div>
        <form method='post'>
          
            <div class="contenitoreregistrazione bianco" >
                <div class="email">
                <label>Email:<input class="casella" type = 'text' name = 'email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></label>
                <span></span>
                </div>
                <div class="password">
                <label>Password:<input class="casella" type = 'password' name = 'password'></label>
                <span></span>
                </div>
                <!--<div class= "remember">
                    <div><label>Ricorda l'accesso<input type='checkbox' name='remember'></label></div>  -->
                    <!-- <label><input class="checkbox" type="checkbox" name="spunta">I'm not a robot</label> -->
                <!--</div> -->

                <?php
                // Verifica la presenza di errori
                if (isset($error1)) {
                    echo "<span class='errore'>$error1</span>";
                }  
            ?>

            </div>
          
            <div class="contenitoreregistrazione">
              <label><input class="casella_invio" type="submit" value="Accedi"></label>
            </div>
          </form> 
          <div class="signup">Non hai un account? <a href="signup.php">Iscriviti</a></div>
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