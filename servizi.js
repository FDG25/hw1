function checkSurname(event) {
    const surname = event.currentTarget;
    
    if (surname.value.length == 0  || /^[a-zA-Z]+$/.test(String(surname.value))) {  
        document.querySelector('.surname span').textContent = "";
        surname.parentNode.parentNode.classList.remove('errorj');
        /*document.querySelector('.surname').classList.add('correctj'); */
        formStatus.surname = true;
        document.querySelector('#trovadottore form').addEventListener('submit', trovaDottore);
    } else {
        document.querySelector('.surname span').textContent = "Cognome non valido!";
        surname.parentNode.parentNode.classList.add('errorj');
        formStatus.surname = false;
        }
        checkForm();
}

function checkName(event) {
    const name = event.currentTarget;
    
    if (name.value.length == 0  || /^[a-zA-Z]+$/.test(String(name.value))) {   
        document.querySelector('.name span').textContent = "";
        name.parentNode.parentNode.classList.remove('errorj');
        /*document.querySelector('.name').classList.add('correctj'); */
        formStatus.name = true;
        document.querySelector('#trovadottore form').addEventListener('submit', trovaDottore);
    } else {
        document.querySelector('.name span').textContent = "Nome non valido!";
        name.parentNode.parentNode.classList.add('errorj');
        formStatus.name = false;
        }
        checkForm();
}

function checkForm(event) {
        event.preventDefault();
        document.querySelector('#trovadottore form').addEventListener('submit', trovaDottore);

        if(Object.values(formStatus).includes(false)) {  
            document.querySelector('#trovadottore form').removeEventListener('submit', trovaDottore);
        }
}


/* function prenotaVisita(event){
    const id_dott = event.currentTarget.dataset.id_dottore;
    //Prenota visita
    fetch("prenota_visita.php?id_dottore=" + id_dott).then(aggiornaStatoPrenotazione);  //crea pagina php e funzione per la prenotazione
    event.preventDefault(); //così l'elemento a non ci riporta in cima quando lo premiamo
}
*/


function mostraDottori(list, element){
        const li = document.createElement("li");
        li.classList.add('listali');
        const div = document.createElement("div");
        div.classList.add("listaimg");
        const img = document.createElement("img");
        img.src = "fotodottori/" + element.foto;
        const divcont = document.createElement("div");
        divcont.classList.add("listacontenuto");
        const cognome_nome = document.createElement("h4");
        cognome_nome.textContent = element.cognome + " " + element.nome;
        
        const chirurgo = document.createElement("p");
        if(element.chirurgo == false){
            chirurgo.textContent = "Chirurgo: no";
        }
        else{
            chirurgo.textContent = "Chirurgo: sì";
        }
        const nomeReparto = document.createElement("p");
        nomeReparto.textContent = "Reparto: " + element.nomereparto;

        /*const prenotaVisita = document.createElement("a");
        prenotaVisita.dataset.id_dottore = element.cf;  //nell'elemento spunterà il data attribute data-id_dottore= "codice fiscale del corrispondente dottore"
        prenotaVisita.textContent = "Prenota";
        prenotaVisita.addEventListener("click", prenotaVisita); */
        li.appendChild(div);
        div.appendChild(img);
        li.appendChild(divcont);
        divcont.appendChild(cognome_nome);
        divcont.appendChild(chirurgo);
        divcont.appendChild(nomeReparto);
        /*divcont.appendChild(prenotaVisita);*/ 

        if(element.cf === element.cfdirettore){
            const primario = document.createElement("p");
            primario.textContent = "Primario presso il reparto di " + element.nomereparto + ".";
            divcont.appendChild(primario);
        }
        list.appendChild(li);

}

function onJson(json) {     
    const lista = document.querySelector(".cont1 ul");
    const divnumdottori = document.querySelector(".numdottori");
    const surname = document.querySelector('.surname input');
    const name = document.querySelector('.name input');
    const reparto = document.getElementById('tipo');
    lista.innerHTML = '';
    let contatore = 0;

    for(element of json){
        //ARRIVATI A QUESTO PUNTO SIAMO SICURI CHE L'UTENTE ABBIA GIà INSERITO NOME E COGNOME IN MANIERA CORRETTA (GRAZIE AI CONTROLLI SOPRA FATTI)
        if(reparto.value.toLowerCase() == ("Tutti i reparti").toLowerCase()){
            if(element.cognome.toLowerCase().includes(surname.value.toLowerCase()) && element.nome.toLowerCase().includes(name.value.toLowerCase())){
                    contatore++;
                    mostraDottori(lista, element);
            }
        } else{
            if(reparto.value.toLowerCase() == element.nomereparto.toLowerCase()){
                if(element.cognome.toLowerCase().includes(surname.value.toLowerCase()) && element.nome.toLowerCase().includes(name.value.toLowerCase())){
                    contatore++;
                    mostraDottori(lista, element);
                }
        }
    }
   }

    const spanavviso = document.createElement("span");
    const avviso1= document.createElement("h4");
    const avviso2= document.createElement("h4");
    divnumdottori.innerHTML = '';
    spanavviso.innerHTML = '';

    if(contatore === 0){
        avviso1.textContent = "Nessun dottore trovato!";
        divnumdottori.innerHTML = '';
        lista.appendChild(spanavviso);
        spanavviso.appendChild(avviso1);
    }
    else{
        avviso2.textContent = "Trovati " + contatore + " dottori!";
        spanavviso.innerHTML = '';
        divnumdottori.appendChild(avviso2);
    }

}

function fetchResponse(response) {
    return response.json();
}

function trovaDottore(event) {
    const form = document.querySelector('#trovadottore form');
    fetch("leggiDottori.php").then(fetchResponse).then(onJson);  
    event.preventDefault();  //non vogliamo fare il submit del form
}


const formStatus = {};
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('#trovadottore form').addEventListener('submit', checkForm);
document.querySelector('#trovadottore form').addEventListener('submit', trovaDottore);