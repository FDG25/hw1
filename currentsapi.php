<?php
    $api_key = "bsjDnHcFqfal6uR2EkdpgfE-ItYc1WFWKC6YJv1zCEsp9gPs";
    
    $url = 'https://api.currentsapi.services/v1/latest-news?language=it&category=health&apiKey='.$api_key;
    
    # Creo il CURL handle per l'URL selezionato
    $curl = curl_init($url);
    # Setto che voglio ritornato il valore, anziché un boolean (default)
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //SPECIFICHIAMO L'OPZIONE CURLOPT_RETURNTRANSFER E LA SETTIAMO A 1 (QUINDI A true) PER DIRE CHE VOGLIAMO RITORNATO NON UN VALORE BOOLEANO COME DI DEFAULT FAREBBE LA RICHIESTA CURL, MA IMPOSTIAMO CHE VOGLIAMO RITORNATO UN JSON CON LA RISPOSTA DEL NOSTRO SERVER
    # Eseguo la richiesta all'URL
    $result = curl_exec($curl);
    # Impacchetto tutto in un JSON
    $json = json_decode($result, true);
    # Libero le risorse
    curl_close($curl);

    $newJson = array();
    # Riformatto l'array
    for ($i = 0; $i < count($json['news']); $i++) {
        $newJson[] = array('title' => $json['news'][$i]['title'], 'description' => $json['news'][$i]['description'], 'url' => $json['news'][$i]['url'], 'image' => $json['news'][$i]['image'], 'published' => $json['news'][$i]['published']);
    }

    # Ritorno l'array
    echo json_encode($newJson);
?>