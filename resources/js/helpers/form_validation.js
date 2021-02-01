'use strict';

var validation = {
    check: function(input) {
        let result = {
            check: true,
            message: "",
        }
    
        switch (input.getAttribute('type')) {
            case 'number':
                if (!constants.regexPatterns.isNumber.test(input.value)) {
                    result.check = false;
                    result.message = "O campo <strong>'" + input.getAttribute('placeholder') + "'</strong> só aceita números!";
                }
            break;

            case 'password':

                // Formulário de nova senha
                if (document.querySelector('.form-newpassword') != null) {


                    let form = document.querySelector('.form-newpassword'),
                        new_password = form.querySelector('#new_password'),
                        is_valid = validate_password_strength(new_password);
                    
                    if (input.value == '') {
                        result.check = false;
                        result.message = "O campo <strong>'" + input.getAttribute('placeholder') + "'</strong> é obrigatório!";
                    } else {
                        if (!is_valid) {
                            result.check = false;
                            result.message = "O campo <strong>" + input.getAttribute('placeholder') + "</strong> não se adequa às regras para uma senha segura.";
                        } else {
                            let new_password = form.querySelector('#new_password').value,
                                confirm_password = form.querySelector('#confirm_password').value;
    
                            if (new_password != confirm_password) {
                                result.check = false;
                                result.message = "A nova senha e a confirmação devem ser iguais!";
                            }
                        }
                    }
                }
            break;

            case 'email':
                if (!constants.regexPatterns.isEmailAddress.test(input.value)) {
                    result.check = false;
                    result.message = "O campo <strong>'" + input.getAttribute('placeholder') + "'</strong> não é válido!";
                }
            break;

            default:
                if (input.value == '') {
                    result.check = false;
                    result.message = "O campo <strong>'" + input.getAttribute('placeholder') + "'</strong> é obrigatório!";
                }
            break;
        }
        
        return result;
    },

    run: function(form) {
        let formdata = {}, messages = "",
            result = {check: true, data: ""};

        for (let i = 0; i < form.length; i++) {
            if (("validate" in form[i].dataset)) {
                let validation = this.check(form[i]);

                if (validation.check) {
                    formdata[form[i].name] = form[i].value;
                } else {
                    messages += "<p>" + validation.message + "</p>";
                }
            }
        }

        let formdata_sz = Object.keys(formdata).length;

        if (messages != "") {
            result.check = false;
            result.data = messages;
        } else if (formdata_sz > 0 && messages == "") {
            result.check = true;

            // Token de validação de requisição
            formdata['csrf_token'] = form.querySelector('[name=csrf_token]').value;

            // Token de atualização de senha (Gerar Nova Senha)
            if (form.querySelector('[name=user_token]') != null) {
                formdata['v'] = form.querySelector('[name=user_token]').value;
            }

            // Formata os dados para QueryString
            var query_string = new URLSearchParams(formdata);
            query_string = query_string.toString();

            result.data = query_string;
        }

        return result;
    }
};
