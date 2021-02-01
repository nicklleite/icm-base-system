/**
 * Validar email
 * 
 * @param {string} email Email a ser validado
 */

var validEmail = function(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

/**
 * Validação de CPF
 * 
 * @param {string} cpf 
 */
var validCpf = function(cpf) {
    if (typeof cpf !== "string") {
        return false;
    }

    cpf = cpf.replace(/[\s.-]*/igm, '');

    if (constants.invalidCPFs.includes(cpf)) {
        return false;
    }

    var sum = 0;
    var rest;

    for (var i = 1; i <= 9; i++) {
        sum = sum + parseInt(cpf.substring(i-1, i)) * (11 - i)
    }

    rest = (sum * 10) % 11
    if ((rest == 10) || (rest == 11)) {
        rest = 0;
    }

    if (rest != parseInt(cpf.substring(9, 10)) ) {
        return false
    }
        
    sum = 0
    for (var i = 1; i <= 10; i++) {
        sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i)
    }

    rest = (sum * 10) % 11
    if ((rest == 10) || (rest == 11)) {
        rest = 0
    }

    if (rest != parseInt(cpf.substring(10, 11))) {
        return false
    }

    return true
}

/**
 * Verificador de senha no momento em que é digitada
 * 
 * @param {Element} el Campo senha a ser verificado
 */
function oninput_check_password(el) {
    let password_value = el.value;

    let label_length = document.querySelector("#password_length");
    if (el.value.length < 8) {
        label_length.setAttribute("style", "color: red");
        label_length.querySelector('.fas').classList.remove('fa-check');
        label_length.querySelector('.fas').classList.add('fa-times');
    } else {
        label_length.setAttribute("style", "color: green");
        label_length.querySelector('.fas').classList.remove('fa-times');
        label_length.querySelector('.fas').classList.add('fa-check');
    }

    let label_lowercase = document.querySelector("#password_lowercase"),
        regex_lowercase = new RegExp("(?=.*[a-z])");
    if (regex_lowercase.test(password_value)) {
        label_lowercase.setAttribute("style", "color: green");
        label_lowercase.querySelector('.fas').classList.add('fa-check');
        label_lowercase.querySelector('.fas').classList.remove('fa-times');
    } else {
        label_lowercase.setAttribute("style", "color: red");
        label_lowercase.querySelector('.fas').classList.remove('fa-check');
        label_lowercase.querySelector('.fas').classList.add('fa-times');
    }
    
    let label_uppercase = document.querySelector("#password_uppercase"),
        regex_uppercase = new RegExp("(?=.*[A-Z])");
    if (regex_uppercase.test(password_value)) {
        label_uppercase.setAttribute("style", "color: green");
        label_uppercase.querySelector('.fas').classList.add('fa-check');
        label_uppercase.querySelector('.fas').classList.remove('fa-times');
    } else {
        label_uppercase.setAttribute("style", "color: red");
        label_uppercase.querySelector('.fas').classList.remove('fa-check');
        label_uppercase.querySelector('.fas').classList.add('fa-times');
    }

    let label_number = document.querySelector("#password_number"),
        regex_number = new RegExp("(?=.*[0-9])");
    if (regex_number.test(password_value)) {
        label_number.setAttribute("style", "color: green");
        label_number.querySelector('.fas').classList.add('fa-check');
        label_number.querySelector('.fas').classList.remove('fa-times');
    } else {
        label_number.setAttribute("style", "color: red");
        label_number.querySelector('.fas').classList.remove('fa-check');
        label_number.querySelector('.fas').classList.add('fa-times');
    }

    let label_special_chars = document.querySelector("#password_special_chars"),
        regex_special_chars = new RegExp("[ !\"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]");
    if (regex_special_chars.test(password_value)) {
        label_special_chars.setAttribute("style", "color: green");
        label_special_chars.querySelector('.fas').classList.add('fa-check');
        label_special_chars.querySelector('.fas').classList.remove('fa-times');
    } else {
        label_special_chars.setAttribute("style", "color: red");
        label_special_chars.querySelector('.fas').classList.remove('fa-check');
        label_special_chars.querySelector('.fas').classList.add('fa-times');
    }
}