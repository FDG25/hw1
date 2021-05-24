<?php 
    /*******************************************************
         L'utente loggato può aggiungere un preferito 
    ********************************************************/
    require_once 'auth.php';
    require_once 'databaseconf.php';
    
    if (checkAuth()) {

    $error = array();
    $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']);

    $query = "INSERT INTO preferiti(id_utente, id_reparto) VALUES('".$_SESSION['_ospedale_user_id']."', '".$_POST['id']."');";

    #VERIFICHIAMO CHE LA QUERY SIA ANDATA A BUON FINE
    if (mysqli_query($conn, $query)) {
        echo "Contenuto aggiunto ai preferiti";
        mysqli_close($conn);
        exit;
    } else {
        $error[] = "Errore di connessione al Database";
        exit;
    }
}  
?>