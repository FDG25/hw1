<?php
    //File php che contiene la variabile che ci permetterà di fare la connessione al database --> array associativo
    $databaseconf = [
        'host'     => '127.0.0.1',  //indirizzo IP o nome di dominio del server (es. "localhost")
        'user'     => 'root',       //nome dell’utente sul server MySQL (es. "root")
        'password' => '',           //non ho impostato una password --> accedo al server MySQL con mysql -u root, senza specificare -p
        'name'     => 'progetto2'   //nome del database sul server --> DB che avevo creato per l'esame di Database
    ];
?>