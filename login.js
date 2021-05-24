//IL CONTROLLO DEI CAMPI NON DOVRà ESSERE FATTO SOLO IN JS, MA ANCHE IN php. 

function jsonCheckEmail(json) {    
    // Controllo il campo exists ritornato dal JSON
    if (json.exists) {   //se nel database esiste quell'email
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.remove('errorj');
        formStatus.email = true;
    } else {
        document.querySelector('.email span').textContent = "Indirizzo email non esistente!";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
    }
    checkForm();
}

function fetchResponse(response) {
    /*if (!response.ok) return null;*/
    return response.json();
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.remove('errorj');
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);   
    } else {
        document.querySelector('.email span').textContent = "Indirizzo email non valido!";
        document.querySelector('.email').classList.add('errorj');
    }
    checkForm();
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (passwordInput.value.length > 0) {  /*Faccio un primo controllo che impedisce all'utente di fare il submit del form se non ha prima inserito almeno un carattere nella password --> in php controllo che sia la password giusta associata a quell'email (e di conseguenza che sia di almeno 8 caratteri)*/
        formStatus.password = true;
    } else {
        formStatus.password = false;
    }
    checkForm();
}

function checkForm(event) {
    if(Object.keys(formStatus).length !== 2 || Object.values(formStatus).includes(false)) {   
        event.preventDefault();
    }
}

const formStatus = {};
document.querySelector('.email input').addEventListener('blur', checkEmail);  //evento blur --> Executes some code when the input loses focus
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('#login form').addEventListener('submit', checkForm);
