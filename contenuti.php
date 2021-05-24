<?php
    require_once 'auth.php';
    require_once 'databaseconf.php';
    
    header('Content-Type: application/json');
    
    // Connessione al DB
    $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));

    $query = "SELECT * from contenuti";

    // Eseguo la query
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Creo l'array che conterrà i miei risultati
    $contenutiArray = array();
    if (mysqli_num_rows($res) > 0) {
        // Se ci sono risultati, li scorro e riempio l'array che ritornerò
        while($entry = mysqli_fetch_assoc($res)) {
            $contenutiArray[] = array('titolo' => $entry['titolo'], 'immagine' => $entry['immagine'], 'descrizione' => $entry['descrizione']);  //la sintassi $contenutiArray[] = , vuol dire metti alla fine di questo array quello che c'è a destra dell'uguale
        }
    }
    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($contenutiArray);

    exit; 
?>