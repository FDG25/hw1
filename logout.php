<?php
    /*include 'databaseconf.php'; */

    // Distruggo la sessione esistente e reindirizzo l'utente al login
    session_start();
    session_destroy();

    header('Location: login.php');
?>