<?php
    require_once 'auth.php';
    require_once 'databaseconf.php';
    
    if (!$userid = checkAuth()) exit;

    /*header('Content-Type: application/json');*/
    
    // Connessione al DB
    $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));
    
    $userid = mysqli_real_escape_string($conn, $userid);

    $query = "SELECT c.titolo as titolo, c.immagine as immagine from contenuti c where c.titolo in (SELECT r.nome from reparto r, preferiti p where r.codice = p.id_reparto AND p.id_utente = '$userid')";
    
    $res = mysqli_query($conn, $query);
    $repartiPreferitiArray = array();
    if (mysqli_num_rows($res) > 0) {
        while($entry = mysqli_fetch_assoc($res)) {
           $repartiPreferitiArray[] = array('titolo' => $entry['titolo'], 'immagine' => $entry['immagine']);
        }
    }
    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($repartiPreferitiArray);

    exit; 
?>