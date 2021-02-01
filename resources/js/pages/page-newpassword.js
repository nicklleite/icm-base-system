'use strict';

const gc_form_new_password = document.querySelector('[name=gc_form_new_password]');

if (gc_form_new_password != null) {
    var new_password__form = gc_form_new_password.querySelector('.form-newpassword'),
        new_password__form__action_button = new_password__form.querySelector('#btn_submit'),
        new_password__form__token = new_password__form.querySelector('[name=csrf_token]'),
        new_password__form__refresh = new_password__form.querySelector('[name=refresh]'),
        new_password__form__redirect = new_password__form.querySelector('[name=redirect]'),
        new_password__form__action = new_password__form.getAttribute('action'),
        gc_validation_messages = gc_form_new_password.querySelector('.gc_validation_messages'),
        gc_validation_messages__title = gc_validation_messages.querySelector(".gc_validation_messages__title"),
        gc_validation_messages__message = gc_validation_messages.querySelector(".gc_validation_messages__message");

    // Gerar nova senha
    new_password__form__action_button.addEventListener('click', function(e) {
        e.preventDefault();

        // Renova mensagens de validação
        gc_validation_messages.classList.add('d-none');
        gc_validation_messages__title.innerHTML = "";
        gc_validation_messages__message.textContent = "";

        // Frescuras visuais
        new_password__form__action_button.value = 'Carregando...';
        new_password__form__action_button.disabled = true;

        // Validação do formulário
        let result = validation.run(new_password__form);

        if (!result.check) {
            // Exibe mensagem de validação
            gc_validation_messages.classList.remove('d-none');
            gc_validation_messages.classList.add('no-title');
            gc_validation_messages__message.innerHTML = result.data;

            // Atualiza token de validação de requisição
            axios.get(new_password__form__refresh.value).then((result_csrf) => {
                new_password__form__token.value = result_csrf.data.token

                // Frescuras visuais
                new_password__form__action_button.value = 'Enviar';
                new_password__form__action_button.disabled = false;
            });
        } else {
            // And here we go...
            axios.post(new_password__form__action, result.data, {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }).then((result) => {
                if (result.data.status === 200) {    
                    window.location.href = new_password__form__redirect.value;
                } else {

                    // Exibe mensagem de validação
                    gc_validation_messages.classList.remove('d-none');
                    gc_validation_messages__title.innerHTML = "Senha inválida! <small class='gc_validation_messages__code'>(Cód.: " + result.data.status + ")</small>";
                    gc_validation_messages__message.append(result.data.message);

                    // Atualiza token de validação de requisição
                    axios.get(new_password__form__refresh.value).then((result_csrf) => {
                        new_password__form__token.value = result_csrf.data.token

                        // Frescuras visuais
                        new_password__form__action_button.value = 'Enviar';
                        new_password__form__action_button.disabled = false;
                    });
                }
            });
        }
    });
}