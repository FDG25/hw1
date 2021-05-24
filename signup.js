function checkName(event) {
    const name = event.currentTarget;
    
    if (name.value.length > 1  && /^[a-zA-Z]+$/.test(String(name.value))) {    /*ESPRESSIONI REGOLARI --> REGEX*/
        document.querySelector('.name span').textContent = "";
        name.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('.name').classList.add('correctj'); 
        formStatus.name = true;
    } else {
        document.querySelector('.name span').textContent = "Nome non valido!";
        name.parentNode.parentNode.classList.add('errorj');
        formStatus.name = false;
        }
        checkForm();
}

function checkSurname(event) {
    const surname = event.currentTarget;
    
    if (surname.value.length > 1  && /^[a-zA-Z]+$/.test(String(surname.value))) {   /*ESPRESSIONI REGOLARI --> REGEX*/
        document.querySelector('.surname span').textContent = "";
        surname.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('.surname').classList.add('correctj'); 
        formStatus.surname = true;
    } else {
        document.querySelector('.surname span').textContent = "Cognome non valido!";
        surname.parentNode.parentNode.classList.add('errorj');
        formStatus.surname = false;
        }
        checkForm();
}

function jsonCheckEmail(json) {     
    // Controllo il campo exists ritornato dal JSON
    if (!json.exists) {  //se nel database non esiste quell'email
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.remove('errorj');
        document.querySelector('.email').classList.add('correctj');
        formStatus.email = true;
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
    }
    checkForm();
}

function fetchResponse(response) {
    return response.json();
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.remove('errorj');
        document.querySelector('.email').classList.add('correctj'); 
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);   
    } else {
        document.querySelector('.email span').textContent = "Email non valida!";
        document.querySelector('.email').classList.add('errorj');
    }
    checkForm();
}

const paragrafo = document.createElement("span");

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(String(passwordInput.value))) {  /*La password deve contenere almeno una lettera maiuscola, almeno un numero e deve essere composta da almeno 8 caratteri.*/
        document.querySelector('.password').classList.remove('errorj');
        document.querySelector('.password').classList.add('correctj'); 
        for(element of document.querySelectorAll('.password span')){
            element.textContent = "";
        }
        formStatus.password = true;
    } else {
        document.querySelector('.password').classList.add('errorj');
        document.querySelector('.password').classList.remove('correctj');
        document.querySelector('.password span').textContent = "Password non valida!";
        paragrafo.textContent = "La password deve contenere almeno una lettera maiuscola, almeno un numero e deve essere composta da almeno 8 caratteri.";
        document.querySelector('.password').appendChild(paragrafo);
        formStatus.password = false;
    }
    checkForm();
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('.confirm_password input');
    if (confirmPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('errorj');
        document.querySelector('.confirm_password').classList.add('correctj'); 
        formStatus.confirm_password = true;
        if (confirmPasswordInput.value.length == 0){
            document.querySelector('.confirm_password').classList.add('errorj');
        }
    } else {
        document.querySelector('.confirm_password').classList.add('errorj');
        formStatus.confirm_password = false;
    }
    checkForm();
}

function checkFlexCheckbox(event) {
    const input = event.currentTarget;
  if (input.checked) {
    formStatus.checkbox = true;
  } else {
    formStatus.checkbox = false;
  }
  checkForm();
}

function checkTelephoneNumber(event){
    const telephone = document.querySelector('.telephone_number input');;
    if(telephone.value.length == 0 || /^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/.test(String(telephone.value))){
        document.querySelector('.telephone_number span').textContent = "";
        document.querySelector('.telephone_number').classList.remove('correctj');
        telephone.parentNode.parentNode.classList.remove('errorj');
        if(/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/.test(String(telephone.value))){
            document.querySelector('.telephone_number').classList.add('correctj'); 
        }
    } else {
        document.querySelector('.telephone_number span').textContent = "Numero di telefono cellulare non valido!";
        telephone.parentNode.parentNode.classList.add('errorj');
        }
        checkForm();
    }

function checkForm(event) {
    if(Object.keys(formStatus).length !== 6 || Object.values(formStatus).includes(false)) {   /*così ci accertiamo che la checkbox sia spuntata, perché se no arriviamo solo a 5 campi/6 compilati*/ 
        event.preventDefault();
    }
}

const formStatus = {};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.telephone_number input').addEventListener('blur', checkTelephoneNumber);
document.querySelector('.flex_checkbox input').addEventListener('click', checkFlexCheckbox);
document.querySelector('#registrazione form').addEventListener('submit', checkForm);

