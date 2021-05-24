    const container = document.querySelector('#principale .titolo');
    const tit = document.createElement("h1");
    tit.textContent = 'I nostri reparti';
        
    const div2 = document.createElement("div");
    const img = document.createElement("img");
    img.src = "lente.png";
    const ingresso = document.createElement("input");
    ingresso.type ='text';
    ingresso.placeholder ='Cerca';

    container.appendChild(tit);
    container.appendChild(div2);
    div2.appendChild(img);
    div2.appendChild(ingresso);

    const lista = [];  //PER TENERE TRACCIA DEI PREFERITI


function inserisciReparti(json){  
    let j = 0;
    let indice = 0;
    for (element of json) {  
        const divdetails = document.querySelectorAll('#principale .details'); 
        const divreparto = document.createElement("div");
        divreparto.setAttribute("data-index", element.titolo.toLowerCase());
        if(divreparto.dataset.index == "cardiologia"){
            divreparto.setAttribute("data-id", 1);
        } 
        if(divreparto.dataset.index == "geriatria"){
            divreparto.setAttribute("data-id", 2);
        } 
        if(divreparto.dataset.index == "nefrologia"){
            divreparto.setAttribute("data-id", 3);
        } 
        if(divreparto.dataset.index == "ortopedia"){
            divreparto.setAttribute("data-id", 4);
        } 
        if(divreparto.dataset.index == "pediatria"){
            divreparto.setAttribute("data-id", 5);
        } 
        if(divreparto.dataset.index == "neurologia"){
            divreparto.setAttribute("data-id", 6);
        } 
        if(divreparto.dataset.index == "radiologia"){
            divreparto.setAttribute("data-id", 7);
        } 
        if(divreparto.dataset.index == "virologia"){
            divreparto.setAttribute("data-id", 8);
        } 
        const imgstellapiu = document.createElement("img");
        imgstellapiu.src = 'stellapiu.png';
        imgstellapiu.classList.add("stella");
        const anchor = document.createElement("a");
        const imgreparto = document.createElement("img");
        imgreparto.src = element.immagine;
        const titreparto = document.createElement("h1");
        titreparto.textContent = element.titolo;
        const paragraph1 = document.createElement("p");
        paragraph1.classList.add("moredetails");
        paragraph1.textContent = 'Clicca per più dettagli';
        const span1 = document.createElement("span");
        span1.classList.add("espandi");
        span1.classList.add("hidden");
        const paragraph2 = document.createElement("p");
        paragraph2.classList.add("otherdetails");
        paragraph2.textContent = element.descrizione;
        const paragraph3 = document.createElement("p");
        paragraph3.classList.add("lessdetails");
        paragraph3.textContent = 'Meno dettagli';

        if(indice <= 3){
            divdetails[j].appendChild(divreparto);
            divreparto.appendChild(imgstellapiu);
            divreparto.appendChild(anchor);
            anchor.appendChild(imgreparto);
            anchor.appendChild(titreparto);
            divreparto.appendChild(paragraph1);
            divreparto.appendChild(span1);
            span1.appendChild(paragraph2);
            span1.appendChild(paragraph3);
        }

        if(indice === 3){
            const divfreccia = document.querySelector('#principale .arrow');
            const imgfreccia = document.createElement("img");
            imgfreccia.src = "down-arrow.png";
            divfreccia.appendChild(imgfreccia);
            j++;
        }

        if(indice >=4){
            divdetails[j].appendChild(divreparto);
            divreparto.appendChild(imgstellapiu);
            divreparto.appendChild(anchor);
            anchor.appendChild(imgreparto);
            anchor.appendChild(titreparto);
            divreparto.appendChild(paragraph1);
            divreparto.appendChild(span1);
            span1.appendChild(paragraph2);
            span1.appendChild(paragraph3);

            if(indice === 7){
                j++;
            }
        }

        if(indice + 1 === json.length){  /*se siamo all'ultimo reparto allora aggiungiamo la freccia finale per tornare su*/ 
            const divfrecciasu = document.querySelector('.altrireparti .arrow');
            const imgfrecciasu = document.createElement("img");
            imgfrecciasu.src = "up-arrow.png";
            divfrecciasu.appendChild(imgfrecciasu);
        }
        indice++;
    }
}

function onJsonContenuti(json) {
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
    
        inserisciReparti(json); 

    //METTO QUI GLI EVENT LISTENER COSì DA ESSERE CERTO CHE I CONTENUTI SIANO STATI GIà CREATI
    const cliccaxdettagli = document.querySelectorAll('.details .moredetails');
    for(cliccaxdettaglio of cliccaxdettagli){
    cliccaxdettaglio.addEventListener('click', mostraDettagli);
    }
   
    const stellaplus = document.querySelectorAll('.details .stella');
    for(const stella of stellaplus){
        stella.addEventListener('click', aggiungiAiPreferiti);
    }
}

function onResponse(response) {
    /*console.log('Risposta ricevuta');*/
    return response.json();
    }

fetch('contenuti.php').then(onResponse).then(onJsonContenuti);


function nascondiReparti(){
    const freccia2 = document.querySelector('#principale .altrireparti .arrow');  
    freccia2.classList.add('hidden');

    const altrirep = document.querySelector('#principale .altrireparti');
    altrirep.classList.add('hidden'); 
    
    const freccia1 = document.querySelector('#principale .arrow');  
    freccia1.addEventListener('click', mostraReparti); 
    freccia1.classList.remove('hidden');
}


function mostraReparti(){
    const freccia1 = document.querySelector('#principale .arrow');  
    freccia1.classList.add('hidden');

    const altrirep = document.querySelector('#principale .altrireparti');
    altrirep.classList.remove('hidden');

    const freccia2 = document.querySelector('#principale .altrireparti .arrow');  
    freccia2.addEventListener('click', nascondiReparti);
    freccia2.classList.remove('hidden');
}


function nascondiDettagli(event){
    const identifier = event.currentTarget.parentNode.parentNode.dataset.index;

    const ulterioridett = document.querySelectorAll('.espandi');
    for(ulterioredett of ulterioridett){
        if(ulterioredett.parentNode.dataset.index === identifier){
        ulterioredett.classList.add('hidden');
        }
    }

    const dettagli = document.querySelectorAll('.moredetails');  
    for(dettaglio of dettagli){
        if(dettaglio.parentNode.dataset.index === identifier){
        dettaglio.addEventListener('click', mostraDettagli);   
        dettaglio.classList.remove('hidden');
        }
    }
}

function mostraDettagli(event){
    const identifier = event.currentTarget.parentNode.dataset.index;  
    console.log(identifier);

    const dettagli = document.querySelectorAll('.moredetails');
    for(dettaglio of dettagli){
        if(dettaglio.parentNode.dataset.index === identifier){
        dettaglio.classList.add('hidden');
        }
    }

    const ulterioridett = document.querySelectorAll('.espandi');
    for(ulterioredett of ulterioridett){
        if(ulterioredett.parentNode.dataset.index === identifier){
        ulterioredett.classList.remove('hidden');
        }
    }

    const menodett = document.querySelectorAll('.lessdetails');
    for(menodet of menodett){
        if(menodet.parentNode.parentNode.dataset.index === identifier){
        menodet.addEventListener('click', nascondiDettagli);
        }
    }
}

function togliDaiPreferiti(event){
    const identifier = event.currentTarget.parentNode.dataset.index; 
    const identif = identifier.toUpperCase();

    const contenitori = document.querySelectorAll('#preferiti .details div');
    const contprincipali = document.querySelectorAll('#principale .details div');
    const section = document.querySelector('#preferiti');

    let i = 0;  
    for (const contenitore of contenitori){
        const title = contenitore.querySelector("h1").textContent;

        if(title.toUpperCase() === identif){ 
            const indice = lista.indexOf(identif);
            lista.splice(indice, 1);  
            contenitore.classList.add("hidden");
            for (const contprincipale of contprincipali){
                if(contprincipale.dataset.index == identifier) {
                    contprincipale.querySelector('.stella').src = "stellapiu.png";
                }
            }
        }
        i++;

        /*const stellamenopref = contenitore.querySelector("#preferiti .details .stella");  */   /*HO CONSEGNATO IL mhw2 CON QUESTA RIGA, MA ERA DA TOGLIERE*/ 

    if(lista.length === 0){
        section.classList.add("hidden");
     }
    }

    const id = event.currentTarget.parentNode.dataset.id;
    const idrep = new FormData();
    idrep.append('id', id); // Mando l'ID alla pagina PHP tramite fetch
    fetch("rimuoviPreferiti.php",{
        method:'post',
        body: idrep}).then(onMex);
}

function onMex(promise){
    return promise.text();
}

function aggiungiAiPreferiti(event){
    const stellapiu = event.currentTarget;
    const identifier = event.currentTarget.parentNode.dataset.index;  
    const identif = identifier.toUpperCase();

    stellapiu.src = "stellameno.png";

    const contenitori = document.querySelectorAll('#preferiti .details div');
    const section = document.querySelector('#preferiti');
    
    for (const contenitore of contenitori){
        const title = contenitore.querySelector("h1").textContent;

        if(title.toUpperCase() === identif){ 
            if(!lista.includes(identif)){
            lista.push(identif);
        }
            section.classList.remove("hidden");
            contenitore.classList.remove("hidden");
        }
    }
       
    for (const contenitore of contenitori){
        const title = contenitore.querySelector("h1").textContent;
        const stellamenopref = contenitore.querySelector("#preferiti .details .stella"); 

            if(!lista.includes(title.toUpperCase())){
                contenitore.classList.add("hidden"); 
            }         
            else{
                stellamenopref.addEventListener('click', togliDaiPreferiti);
            }
    }

    const id = event.currentTarget.parentNode.dataset.id;
    const idrep = new FormData();
    idrep.append('id', id); // Mando l'ID alla pagina PHP tramite fetch
    fetch("aggiungiPreferiti.php",{
        method:'post',
        body: idrep}).then(onMex);
}
 

function mostraRicerca(event){
    const ricerca = event.currentTarget;
    const contenitori = document.querySelectorAll('#principale .details div');
    const parole = ricerca.value.toUpperCase(); 
  
    const freccia1 = document.querySelector('#principale .arrow'); 
    freccia1.classList.add('hidden');

    const altrirep = document.querySelector('#principale .altrireparti');
    altrirep.classList.remove('hidden');

    const freccia2 = document.querySelector('#principale .altrireparti .arrow'); 
    freccia2.classList.add('hidden');   


    for (const contenitore of contenitori){
        const title = contenitore.querySelector("h1").textContent;

        if(title.toUpperCase().indexOf(parole) !== -1){ 
            contenitore.classList.remove("hidden");
        }
        else{
            contenitore.classList.add("hidden");
        }
    }
}

const frecciasotto = document.querySelector('#principale .arrow');  
frecciasotto.addEventListener('click', mostraReparti);


const ricerca = document.querySelector('input');
ricerca.addEventListener('keyup', mostraRicerca); 






