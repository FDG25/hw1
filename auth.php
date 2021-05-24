<?php
    /********************************************************
       Controlla che l'utente sia già autenticato       
    *********************************************************/
    
    require_once 'databaseconf.php';
    session_start();

    function checkAuth() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['_ospedale_user_id'])) { 
            return $_SESSION['_ospedale_user_id'];
        } else 
            return 0;
    }
?>