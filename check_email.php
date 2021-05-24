<?php
    /*******************************************************
        Controlla che l'email sia unica e ritorna un JSON con il solo campo exists, che è un boolean
    ********************************************************/
    
    require_once 'databaseconf.php';
    
    // Controllo che l'accesso sia legittimo
    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }  

    // Imposto l'header della risposta
    header('Content-Type: application/json');
    
    // Connessione al DB
    $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));

    // Leggo la stringa dell'email
    $email = mysqli_real_escape_string($conn, $_GET["q"]);  //PRENDIAMO IL VALORE GET che corrisponde alla chiave q (in questo caso è l'email) e facciamo l'escape di questa stringa

    // Costruisco la query
    $query = "SELECT email FROM account WHERE email = '$email'";

    // Eseguo la query
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Ritorna un JSON con chiave exists --> il valore che corrisponde a questa chiave è un boolean
    //RITORNIAMO IL JSON CON echo
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));  //json encode vuole in ingresso un array associativo  //se il res è > 0 vuol dire che l'email esiste già

    // Chiudo la connessione
    mysqli_close($conn);
?>