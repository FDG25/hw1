const contenitore = document.querySelector("#novita .containerinterno");

function creaBoxNews(titolo, immagine, descrizione, link, data){
    const divbox = document.createElement('div');
    divbox.classList.add('box');
    const divimgbox = document.createElement('div');
    const image = document.createElement('img');
    image.src = immagine;
    const spanx = document.createElement('span');
    data = data.substring(0, 10);  
    spanx.textContent = data; 
    const divboxcontent = document.createElement('div');
    divboxcontent.classList.add('boxcontent');
    const intestazione = document.createElement('h4');
    /*Eliminiamo la scritta "- Salute & benessere", che è presente di default alla fine di ogni titolo nel file JSON.*/ 
    titolo = titolo.split("- Salute & Benessere").shift();  
    intestazione.textContent = titolo;

    const parx = document.createElement('p');
    /*Limitiamo la lunghezza delle descrizioni*/ 
    if(descrizione.length > 186){
        descrizione = descrizione.substring(0,186) + '...';
    }

    parx.textContent = descrizione;
    const anchor = document.createElement('a');
    anchor.textContent = 'Scopri di più';
    anchor.href = link;

    contenitore.appendChild(divbox);
    divbox.appendChild(divimgbox);
    divimgbox.appendChild(image);
    divimgbox.appendChild(spanx);
    divbox.appendChild(divboxcontent);
    divboxcontent.appendChild(intestazione);
    divboxcontent.appendChild(parx);
    divbox.appendChild(anchor);
}

function onJsonNews(json) {
    console.log('JSON ricevuto');
    console.log(json);

    if (json.status == 400) {
        const error = document.createElement("h1"); 
        const mex = document.createTextNode(json.detail); 
        error.appendChild(mex); 
        stats1.appendChild(error);
        return;
      }
      
      if(json.length == 0) {
	    const errore = document.createElement("h1"); 
	    const messaggio = document.createTextNode("Nessun risultato!"); 
	    errore.appendChild(messaggio); 
	    library.appendChild(errore);
        }

        let i = 0;
        contenitore.innerHTML = '';
        for(result of json) {
            creaBoxNews(result.title, result.image, result.description, result.url, result.published);
            
            if(i>=2){  
                break;   
            }
            i++;
        }  
}

function onResponse(response) {
    /*console.log('Risposta ricevuta');*/
    return response.json();
    }

fetch('currentsapi.php').then(onResponse).then(onJsonNews);

/*------------------------------------------------------------------*/

/*Le variabili dichiarate con const non possono essere riassegnate --> per questo non lo utilizziamo*/ 

let today = new Date();
let yesterday = new Date(today);
let dd;
let mm;
let yyyy;

function calcolaDataOggi(){
    dd = String(today.getDate()).padStart(2, '0');
    mm = String(today.getMonth() + 1).padStart(2, '0');  //Gennaio corrisponde a 0
    yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd; 
}

function calcolaDataIeri(){
    yesterday.setDate(yesterday.getDate() - 1);
    dd = String(yesterday.getDate()).padStart(2, '0');
    mm = String(yesterday.getMonth() + 1).padStart(2, '0');  //Gennaio corrisponde a 0
    yyyy = yesterday.getFullYear();
    yesterday = yyyy + '-' + mm + '-' + dd; 
}

/*
/* CREDO ABBIANO ELIMINATO I DATI
const stats1 = document.querySelector("#covidupdate .statistiche");

function creaParagrafiCovid(json, ultimoindice, ultimadata){
    stats1.innerHTML = '';

    for (let index in PARAGRAFI_COVID) { 
    const divx = document.createElement('div');
    const parx = document.createElement('p');
    parx.classList.add('coloured');
    parx.textContent = PARAGRAFI_COVID[index].titolo;
    stats1.appendChild(divx);
    divx.appendChild(parx);

    const valore = document.createElement('p');
    valore.textContent = json[ultimoindice][PARAGRAFI_COVID[index].chiave];
    divx.appendChild(valore);
    }

    const ultimoaggiornamentoCovid = document.createElement('span');
    const paragrafoCovid = document.createElement("p");
    paragrafoCovid.textContent = 'Data di ultimo aggiornamento: ' + ultimadata;
    paragrafoCovid.classList.add("lastupdate");
    stats1.appendChild(ultimoaggiornamentoCovid);
    ultimoaggiornamentoCovid.appendChild(paragrafoCovid);
}

function onJsonCovid(json) {
    console.log('JSON ricevuto');
    console.log(json);

    if (json.status == 400) {
        const error = document.createElement("h1"); 
        const mex = document.createTextNode(json.detail); 
        error.appendChild(mex); 
        stats1.appendChild(error);
        return;
      }
      
    const ultimoindice = (json.length)-1
    const ultimadata = json[ultimoindice].data;
    
    creaParagrafiCovid(json, ultimoindice, ultimadata);
}

url_covid = 'https://openpuglia.org/api/?q=getdatapccovid-19&reg=' + 'sicilia';
console.log('URL: ' + url_covid);
        
fetch(url_covid).then(onResponse).then(onJsonCovid);  */

/*-------------------------------------------------------*/

const stats2 = document.querySelector("#coviditaliaupdate .statistiche");

function creaParagrafiCovidItalia(json, data, risultato){
    stats2.innerHTML = '';

    for (let index in PARAGRAFI_COVID_ITALIA) { 
    const divx = document.createElement('div');
    const parx = document.createElement('p');
    parx.classList.add('coloured');
    parx.textContent = PARAGRAFI_COVID_ITALIA[index].titolo;
    stats2.appendChild(divx);
    divx.appendChild(parx);

    const valore = document.createElement('p');
    valore.textContent = risultato[PARAGRAFI_COVID_ITALIA[index].chiave];
    divx.appendChild(valore);
    }

    const ultimoaggiornamentoCovidItalia = document.createElement('span');
    const paragrafoCovidItalia = document.createElement("p");
    data = data.substring(0, 10);
    paragrafoCovidItalia.textContent = 'Data di ultimo aggiornamento: ' + data;
    paragrafoCovidItalia.classList.add("lastupdate");
    stats2.appendChild(ultimoaggiornamentoCovidItalia);
    ultimoaggiornamentoCovidItalia.appendChild(paragrafoCovidItalia); 
}

function onJsonCovidItalia(json) {
    console.log('JSON ricevuto');
    console.log(json);

    if (json.status == 400) {
        const error = document.createElement("h1"); 
        const mex = document.createTextNode(json.detail); 
        error.appendChild(mex); 
        stats2.appendChild(error);
        return;
      }
    
      const results = json.Countries;
      
      if(results.length == 0) {
	    const errore = document.createElement("h1"); 
	    const messaggio = document.createTextNode("Nessun risultato!"); 
	    errore.appendChild(messaggio); 
	    library.appendChild(errore);
        }

        for(result of results) {
            if(result.Country === "Italy"){
                creaParagrafiCovidItalia(json, result.Date, result);
            }
        }  
}

url_covid_italia = "https://api.covid19api.com/summary";
console.log('URL: ' + url_covid_italia);
        
fetch(url_covid_italia).then(onResponse).then(onJsonCovidItalia);


/*------------------------------------------------*/

const stats3 = document.querySelector("#vacciniupdate .statistiche");

function creaParagrafiVaccini(json, risultato){
    stats3.innerHTML = '';

    for (let index in PARAGRAFI_VACCINI) { 
        const divx = document.createElement('div');
        const parx = document.createElement('p');
        parx.classList.add('coloured');
        parx.textContent = PARAGRAFI_VACCINI[index].titolo;
        stats3.appendChild(divx);
        divx.appendChild(parx);

        const valore = document.createElement('p');
        valore.textContent = risultato[PARAGRAFI_VACCINI[index].chiave];
        divx.appendChild(valore);
    }
}

function onJsonVaccini(json) {
    console.log('JSON ricevuto');
    console.log(json); 

    if (json.status == 400) {
        const error = document.createElement("h1"); 
        const mex = document.createTextNode(json.detail); 
        error.appendChild(mex); 
        stats3.appendChild(error);
        return;
      }

      const ultimoaggiornamentoVaccini = document.createElement('span');
      const paragrafoVaccini = document.createElement("p");

      calcolaDataOggi();
      calcolaDataIeri();
      const results = json.data;
      
  
      if(results.length == 0) {
	    const errore = document.createElement("h1"); 
	    const messaggio = document.createTextNode("Nessun risultato!"); 
	    errore.appendChild(messaggio); 
	    library.appendChild(errore);
        }

        let k = 0;
        for(result of results) {
            if(result.data_somministrazione.localeCompare(today + "T00:00:00.000Z") === 0){
                if (result.codice_regione_ISTAT === 19){
                    ++k;
                    creaParagrafiVaccini(json, result);
                    paragrafoVaccini.textContent = 'Data di ultimo aggiornamento: ' + today;
                    if(k === 1){  /*ESSENDO CHE I DATI SONO MESSI IN DISORDINE, QUESTO ULTERIORE CONTROLLO MI ASSICURA CHE UNA VOLTA TROVATA LA DATA DI OGGI (CHE SARà CERTAMENTE L'ULTIMA DATO CHE I DATI VENGONO CARICATI UNA VOLTA AL GIORNO) IL CICLO SI INTERROMPA --> SE NON è PRESENTE LA DATA DI OGGI, CERTAMENTE CI SARà QUELLA DEL GIORNO PRECEDENTE, PROPRIO PER QUELLA CHE è LA STRUTTURA DEL FILE JSON.*/ 
                        k = 0;
                        break;
                    }
            }
           }
            else{
                if(result.data_somministrazione.localeCompare(yesterday + "T00:00:00.000Z") === 0){
                    if (result.codice_regione_ISTAT === 19){
                        creaParagrafiVaccini(json, result);
                        paragrafoVaccini.textContent = 'Data di ultimo aggiornamento: ' + yesterday;
                }
            }
           }
    } 

    paragrafoVaccini.classList.add("lastupdate");
    stats3.appendChild(ultimoaggiornamentoVaccini);
    ultimoaggiornamentoVaccini.appendChild(paragrafoVaccini);
}

url_vaccini= 'https://raw.githubusercontent.com/italia/covid19-opendata-vaccini/master/dati/somministrazioni-vaccini-summary-latest.json';
console.log('URL: ' + url_vaccini); 
        
fetch(url_vaccini).then(onResponse).then(onJsonVaccini);