<?php
    require_once 'auth.php';
    require_once 'databaseconf.php';

    if (checkAuth()) {
        header("Location: mhw3.php");
        exit;
    }   

    // Verifica l'esistenza di dati POST
    if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && 
        !empty($_POST["confirm_password"]) && !empty($_POST["flex_checkbox"]))
    {
        $error = array();
        $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));

         # EMAIL
         if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {  //SPECIFICHIAMO FILTER_VALIDATE_EMAIL PER CONTROLLARE SE IL TESTO INSERITO EFFETTIVAMENTE è UN INDIRIZZO EMAIL VALIDO 
          $error[] = "Email non valida";
      } else {
          $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
          $res = mysqli_query($conn, "SELECT email FROM account WHERE email = '$email'");
          if (mysqli_num_rows($res) > 0) {
              $error[] = "Email già utilizzata";
          }
      }
       
        # PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Password troppo corta";
        } 
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            
            $email = mysqli_real_escape_string($conn, $_POST["email"]);  

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);  /*è bene cifrare la password prima di memorizzarla --> applichiamo una funzione di hash -->password_hash con PASSWORD_BCRYPT ci ritorna una stringa di 60 caratteri --> nel database abbiamo l'attributo password definito come varchar(255), quindi ci entra tranquillamente*/ 
            $telephone = mysqli_real_escape_string($conn, $_POST['telephone_number']);

            if (isset($_POST['email_checkbox'])) {
              $email_checkbox = true;
              }
              else{
                $email_checkbox = false;
              }

            $query = "INSERT INTO account(email, name, surname, password, telephone, checkbox_email) VALUES('$email', '$name', '$surname', '$password', '$telephone', '$email_checkbox')";
            
          #VERIFICHIAMO CHE LA QUERY SIA ANDATA A BUON FINE
            if (mysqli_query($conn, $query)) {
                $_SESSION["_ospedale_email"] = $_POST["email"];
                $_SESSION["_ospedale_user_id"] = mysqli_insert_id($conn);  /*id (abbiamo autoincrement nel DB) che ci è stato generato dall'inserimento nel database del nuovo utente che si è registrato*/ 
                mysqli_free_result($res);
                mysqli_close($conn);
                header("Location: mhw3.php");  
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["email"])) {
        $error = array("Riempi tutti i campi");
    }
?>

<html>

  <head>
    <meta charset="utf-8">
    <title>Iscriviti | Azienda Ospedaliera di Giarre</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap|https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href= "mhw3.css">
    <script src="signup.js" defer="true"></script>  
  </head>

  <body class = "iscrizione">
    <header>
        <h1>
          <strong>Iscriviti</strong>
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
          <?php if (!checkAuth()) { echo '<a class="effetto" href="login.php">Accedi</a>';} ?>
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

    <section id="registrazione">
        <div class="contenitoretitolo">
              <h2>Registrati</h2>
              <p>Attenzione: i campi contrassegnati da un (*) sono obbligatori</p>
              <span class="avviso"></span>
        </div>
        <form method='post'>
          
            <div class="contenitoreregistrazione bianco">
            <div class="name">
              <label>Nome*<input class="casella" type = 'text' name = 'name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></label>
              <span></span>
            </div>  <!--div messi per allontanare le varie caselle fra loro-->
            <div class="surname">
              <label>Cognome*<input class="casella" type = 'text' name = 'surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>></label>
              <span></span>
            </div>
            <div class="email">
              <label>Email*<input class="casella" type = 'text' name = 'email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></label>
              <span></span>
            </div>
            <div class="password">
              <label>Password*<input class="casella" type = 'password' name = 'password' ></label>
              <span>La password deve contenere almeno una lettera maiuscola, almeno un numero e deve essere composta da almeno 8 caratteri.</span>
            </div>
            <div class="confirm_password">
              <label>Conferma Password*<input class="casella" type = 'password' name = 'confirm_password'></label>
              <span></span>
            </div>
            <div class="telephone_number">
              <label>Telefono Cellulare<input class="casella" type = 'text' name = 'telephone_number' ?></label>
              <span></span>
            </div>
            
            <div class="flex_checkbox">
            <label><input class="checkbox" type = 'checkbox' name = 'flex_checkbox'> Dichiaro di aver preso visione dell’informativa relativa al trattamento dei dati personali.*</label>
            </div>
            <div class="flex_checkbox">
            <label><input type = 'checkbox' name = 'email_checkbox'> Autorizzo l'invio tramite E-MAIL di news di servizio e aggiornamento sulle attività dell'Azienda Ospedaliera di Giarre.</label>
            </div>
            </div>
            
            <div class="contenitoreregistrazione">
              <label><input class="casella_invio" type="submit" value="Crea account"></label>
              <span></span>
            </div>
          </form> 

          <div class="signup">Hai già un account? <a href="login.php">Accedi</a></div>
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