<?php
    require_once 'auth.php';
    require_once 'databaseconf.php';
    
    header('Content-Type: application/json');
    
    // Connessione al DB
    $conn = mysqli_connect($databaseconf['host'], $databaseconf['user'], $databaseconf['password'], $databaseconf['name']) or die(mysqli_error($conn));

    $query = "SELECT m.cf as cf, m.cognome as cognome, m.nome as nome, m.chirurgo as chirurgo, m.codice_reparto as codicereparto, m.foto as foto, r.nome as nomereparto, r.cf_medico_direttore as cfdirettore FROM medico m, reparto r WHERE m.codice_reparto = r.codice ORDER BY m.cognome";

    // Eseguo la query
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Creo l'array che conterrà i miei risultati
    $doctorArray = array();
    if (mysqli_num_rows($res) > 0) {
        // Se ci sono risultati, li scorro e riempio l'array
        while($entry = mysqli_fetch_assoc($res)) {
            $doctorArray[] = array('cf' => $entry['cf'], 'cognome' => $entry['cognome'], 'nome' => $entry['nome'], 'chirurgo' => $entry['chirurgo'], 
                            'codicereparto' => $entry['codicereparto'], 'foto' => $entry['foto'], 'nomereparto' => $entry['nomereparto'], 
                            'cfdirettore' => $entry['cfdirettore']);  //la sintassi $doctorArray[] = , vuol dire metti alla fine di questo array quello che c'è a destra dell'uguale
        }
    }
    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($doctorArray);

    exit; 
?>