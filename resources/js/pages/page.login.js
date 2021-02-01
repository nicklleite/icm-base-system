'use strict';

const gc_form_login = document.querySelector("[name=gc_form_login]");

if (gc_form_login != null) {
    var login__form = gc_form_login.querySelector('.form-login'),
        login__form__action_button = login__form.querySelector('#btn_login'),
        login__form__action_button_admin = login__form.querySelector("#btn_login_admin"),
        login__form__token = login__form.querySelector('[name=csrf_token]'),
        login__form__refresh = login__form.querySelector('[name=refresh]'),
        login__form__redirect = login__form.querySelector('[name=redirect]'),
        login__form__action = login__form.getAttribute('action'),
        gc_validation_messages = gc_form_login.querySelector('.gc_validation_messages'),
        gc_validation_messages__title = gc_validation_messages.querySelector(".gc_validation_messages__title"),
        gc_validation_messages__message = gc_validation_messages.querySelector(".gc_validation_messages__message");
    
    // Login padrão
    login__form__action_button.addEventListener('click', function(e) {
        e.preventDefault();

        // Renova mensagens de validação
        gc_validation_messages.classList.add('d-none');
        gc_validation_messages__title.innerHTML = "";
        gc_validation_messages__message.textContent = "";

        // Frescuras visuais
        login__form__action_button.value = 'Carregando...';
        login__form__action_button.disabled = true;

        // Validação do formulário
        let result = validation.run(login__form);

        if (!result.check) {
            // Exibe mensagem de validação
            gc_validation_messages.classList.remove('d-none');
            gc_validation_messages__title.innerHTML = "Login inválido! <small class='gc_validation_messages__code'>(Cód.: 401)</small>";
            gc_validation_messages__message.innerHTML = result.data;

            // Atualiza token de validação de requisição
            axios.get(login__form__refresh.value).then((result_csrf) => {
                login__form__token.value = result_csrf.data.token

                // Frescuras visuais
                login__form__action_button.value = 'Enviar';
                login__form__action_button.disabled = false;
            });
        } else {
            // And here we go...
            axios.post(login__form__action, result.data, {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }).then((result) => {
                if (result.data.status === 200) {    
                    window.location.href = login__form__redirect.value;
                } else {

                    // Exibe mensagem de validação
                    gc_validation_messages.classList.remove('d-none');
                    gc_validation_messages__title.innerHTML = "Login inválido! <small class='gc_validation_messages__code'>(Cód.: " + result.data.status + ")</small>";
                    gc_validation_messages__message.append(result.data.message);

                    // Atualiza token de validação de requisição
                    axios.get(login__form__refresh.value).then((result_csrf) => {
                        login__form__token.value = result_csrf.data.token

                        // Frescuras visuais
                        login__form__action_button.value = 'Enviar';
                        login__form__action_button.disabled = false;
                    });
                }
            });
        }
    });
    
    // Login de administrador
    if (login__form__action_button_admin != null) {
        // console.log(login__form__action_button_admin);
    }    
}