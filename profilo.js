function inserisciReparti(json){  
let j = 0;
let indice = 0;
const par = document.createElement("p");
par.textContent = "";

for (element of json) {  
    const divdetails = document.querySelectorAll('#preferiti .details'); 
    const divreparto = document.createElement("div");
    divreparto.setAttribute("data-index", element.titolo.toLowerCase());
    const anchor = document.createElement("a");
    const imgreparto = document.createElement("img");
    imgreparto.src = element.immagine;
    const titreparto = document.createElement("h1");
    titreparto.textContent = element.titolo;

    if(indice <= 3){
        divdetails[j].appendChild(divreparto);
        divreparto.appendChild(anchor);
        anchor.appendChild(imgreparto);
        anchor.appendChild(titreparto);
    }

    if(indice === 3){
        j++;
    }

    if(indice >=4){
        divdetails[j].appendChild(divreparto);
        divreparto.appendChild(anchor);
        anchor.appendChild(imgreparto);
        anchor.appendChild(titreparto);

    if(indice === 7){
        j++;
    }
   }
   indice++;
 }

 if(json.length == 0){
    const divdetails = document.querySelector('#preferiti .details'); 
    par.textContent = "Nessun reparto aggiunto tra i preferiti";
    divdetails.appendChild(par);
 }
}

function onJsonPrefer(json) {
    console.log('JSON ricevuto');
    console.log(json);

    inserisciReparti(json); 
  
}

function onResponse(response) {
    /*console.log('Risposta ricevuta');*/
    return response.json();
    }

function aggiornaPreferiti() {
    fetch('ritornaPreferiti.php').then(onResponse).then(onJsonPrefer);
}


aggiornaPreferiti();