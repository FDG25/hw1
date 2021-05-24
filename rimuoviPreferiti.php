<?php 
    /*******************************************************
         L'utente loggato può rimuovere un preferito 
    ********************************************************/

    require_once 'auth.php';
    require_once 'databaseconf.php';
    
    if (checkAuth()) {

    $error = array();
    $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']);

    $userid = mysqli_real_escape_string($conn, $_SESSION['_ospedale_user_id']);
    $idreparto= mysqli_real_escape_string($conn, $_POST['id']);  //FACCIAMO COMUNQUE L'ESCAPE

    // Elimino l'entry dai preferiti
    $query = "DELETE FROM preferiti WHERE id_utente = '$userid' AND id_reparto = '$idreparto';";  
    
    #VERIFICHIAMO CHE LA QUERY SIA ANDATA A BUON FINE
    if (mysqli_query($conn, $query)) {
        echo "Contenuto rimosso dai preferiti";
        mysqli_close($conn);
        exit;
    } else {
        $error[] = "Errore di connessione al Database";
        exit;
    }
}  
?>



