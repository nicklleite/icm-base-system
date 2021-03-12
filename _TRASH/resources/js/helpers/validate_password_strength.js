'use strict';

/**
 * Verificador de senha no momento do envio
 * 
 * @param {Element} el Campo senha a ser verificado
 */
var validate_password_strength = function(el) {
    let password_value = el.value,
        count = 0;

    if (password_value.length < 8) {
        count += 1;
    }

    // Verifica se há ao menos uma letra minúscula
    let regex_lowercase = new RegExp("[a-z]");
    if (!regex_lowercase.test(password_value)) {
        count += 1;
    }
    
    // Verifica se há ao menos uma letra maiúscula
    let regex_uppercase = new RegExp("[A-Z]");
    if (!regex_uppercase.test(password_value)) {
        count += 1;
    }

    // Verifica se há ao menos um número
    let regex_number = new RegExp("[0-9]");
    if (!regex_number.test(password_value)) {
        count += 1;
    }

    // Verifica se há ao menos um caractér especial
    let regex_special_chars = new RegExp("[ !\"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]");
    if (!regex_special_chars.test(password_value)) {
        count += 1;
    }

    // Verifica se há sequencias de caracteres iguais
    

    if (count > 0) {
        return false;
    } else {
        return true;
    }
}