<?php
    require_once 'databaseconf.php';
    require_once 'auth.php';

    // Verifica l'esistenza di dati POST
    if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["message"])) {
        $error = array();
        $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));

         # EMAIL
         if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {  //SPECIFICHIAMO FILTER_VALIDATE_EMAIL PER CONTROLLARE SE IL TESTO INSERITO EFFETTIVAMENTE è UN INDIRIZZO EMAIL VALIDO 
          $error[] = "Email non valida";
      } else {
          $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
      }

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            
            $email = mysqli_real_escape_string($conn, $_POST["email"]);  
            $mex = mysqli_real_escape_string($conn, $_POST['message']);
            $orario = date("Y-m-d H:i:s"); 

            $query = "INSERT INTO messaggi(name, surname,  email, mex, tempo) VALUES('$name', '$surname', '$email', '$mex', '$orario')";
            
          #VERIFICHIAMO CHE LA QUERY SIA ANDATA A BUON FINE
            if (mysqli_query($conn, $query)) {
                mysqli_close($conn);
                header("Location: avviso.php");  //REINDIRIZZIAMO L'UTENTE
                exit;
            } else {
                $error[] = "Errore nell'invio del messaggio!";
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
    <title>Contattaci | Azienda Ospedaliera di Giarre</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap|https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href= "mhw3.css">
    <script src="contattaci.js" defer="true"></script>  
  </head>

  <body id="contact">
    <header>
        <h1>
          <strong>Contatti e Numeri Utili</strong>
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
        
    <section id="contactus">
        <div class="contenitorecontattaci">
        <img src="email.png">
        <h2>Contattaci</h2>
        <p>*Riempire tutti i campi*</p>
        <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    $stampa = end($error);
                    echo "<span class='errorj'>$stampa</span>";
                }           
         ?>

          <form method="post" id="formcontattaci">
          
            <div class="contenutoformcontattaci name">
              <label>Nome<input type="text" name="name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></label>
              <span></span>
            </div>
      
            <div class="contenutoformcontattaci surname">
              <label>Cognome<input type="text" name="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>></label>
              <span></span>
            </div>
      
            <div class="contenutoformcontattaci email">
              <label>Email<input type="text" name="email"></label>
              <span></span>
            </div>
      
            <div class="contenutoformcontattaci message">
              <label>Messaggio<textarea style="resize: none;" name="message" rows="10"></textarea></label>  <!--NON VISTO A LEZIONE -> QUESTO ELEMENTO HTML CREA UNA CASELLA RIDIMENSIONABILE, MA CON style="resize:none;" HO VIETATO QUESTA COSA-->
              <span></span>
            </div>
      
            <div>
            <label><input class="casella_invia" type="submit" value="Invia"></label>
            </div>
          </form>
        </div>
      </section>


      <section class = "informazioni">
      <div class="contenitoreregistrazione">
      <h2>Prenotazioni visite ed esami in Libera Professione</h2>
      </div>
      <div class="contenitorecontatti">
      <div class="contattiinterno">
        <div class="icone">
          <img src="telefono.png">
          <h4>Telefono</h4>
          <p>111 1111111</p>
        </div>
      </div>

        <div class="contattiinterno">
          <div class="icone">
            <img src="smartphone.png">
            <h4>Cellulare</h4>
            <p>394 9492939</p>
          </div>
        </div>
        
        <div class="contattiinterno">
          <div class="icone">
            <img src="chiocciola.png">
            <h4>Email</h4>
            <p>prova1@hotmail.it</p>
          </div>
        </div>
       </div>
       <div class="utili">
       <div class="contenitoreregistrazione">
       <p>Lun – Ven: 9.00-18.00 / Sabato 9.00-12.00</p>
       </div>
       </div>  
      </section>

    <section class = "informazioni">
      <div class="contenitoreregistrazione">
      <h2>Centro Prelievi</h2>
      </div>
      <div class="contenitorecontatti">
        <div class="contattiinterno">
          <div class="icone">
            <img src="telefono.png">
            <h4>Telefono</h4>
            <p>222 2222222</p>
          </div>
        </div>

        <div class="contattiinterno">
          <div class="icone">
            <img src="posizione.png">
            <h4>Indirizzo</h4>
            <p>Prova2, 455544</p>
          </div>
        </div>
        
        <div class="contattiinterno">
          <div class="icone">
            <img src="chiocciola.png">
            <h4>Email</h4>
            <p>prova2@hotmail.it</p>
          </div>
        </div>
       </div>
       <div class="utili">
       <div class="contenitoreregistrazione">
       <p>Lun. - Ven: 8.00 – 12.30</p>
       </div>
       </div>  
      </section>

        <section class = "informazioni">
          <div class="contenitoreregistrazione">
          <h2>Ufficio Cartelle Cliniche</h2>
          </div>
          <div class="contenitorecontatti">
            <div class="contattiinterno">
              <div class="icone">
                <img src="telefono.png">
                <h4>Telefono</h4>
                <p>333 3333333</p>
              </div>
            </div>
            
            <div class="contattiinterno">
              <div class="icone">
                <img src="posizione.png">
                <h4>Indirizzo</h4>
                <p>Prova3, 212112</p>
              </div>
            </div>
            
            <div class="contattiinterno">
              <div class="icone">
                <img src="chiocciola.png">
                <h4>Email</h4>
                <p>prova3@hotmail.it</p>
              </div>
            </div>
           </div>
           <div class="utili">
           <div class="contenitoreregistrazione">
           <p>Lun – Ven: 8.00 – 15.00</p>
           </div>
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