function checkName(event) {
    const input = event.currentTarget;
    
    if (input.value.length > 1  && /^[a-zA-Z]+$/.test(String(input.value))) {   
        input.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('.name').classList.add('correctj'); 
        formStatus.name = true;
    } else {
        input.parentNode.parentNode.classList.add('errorj');
        formStatus.name = false;
        }
        checkForm();
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    if (input.value.length > 1 && /^[a-zA-Z]+$/.test(String(input.value))) {  
        input.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('.surname').classList.add('correctj'); 
        formStatus.surname = true;
    } else {
        input.parentNode.parentNode.classList.add('errorj');
        formStatus.surname = false;
        }
        checkForm();
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.remove('errorj');
        document.querySelector('.email').classList.add('correctj');
        formStatus.email = true;    
    } else {
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
    }
    checkForm();
}

function checkMessage(event) {
    const textarea = event.currentTarget;
    
    if (textarea.value.length > 0) {  
        textarea.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('.message').classList.add('correctj'); 
        formStatus.message = true;
    } else {
        textarea.parentNode.parentNode.classList.add('errorj');
        formStatus.message = false;
        }
        checkForm();
}

function checkForm(event) {
    if(Object.keys(formStatus).length !== 4 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}

const formStatus = {};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.message textarea').addEventListener('blur', checkMessage);
document.querySelector('#contactus form').addEventListener('submit', checkForm);