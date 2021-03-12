'use strict';

const icm_form_forgot_password = document.querySelector('[name=icm_form_forgot_password]');

if (icm_form_forgot_password != null) {
    var forgot_password__form = icm_form_forgot_password.querySelector('.form-forgotpassword'),
        forgot_password__form__token = forgot_password__form.querySelector('[name=csrf_token]'),
        forgot_password__form__redirect = forgot_password__form.querySelector('[name=redirect]'),
        forgot_password__form__refresh = forgot_password__form.querySelector('[name=refresh]'),
        forgot_password__form__btn = forgot_password__form.querySelector('#btn_forget_password'),
        icm_validation_messages = icm_form_forgot_password.querySelector('.icm_validation_messages'),
        icm_validation_messages__title = icm_validation_messages.querySelector(".icm_validation_messages__title"),
        icm_validation_messages__message = icm_validation_messages.querySelector(".icm_validation_messages__message");

    forgot_password__form__btn.addEventListener('click', function(e) {
        e.preventDefault();

        // Renova mensagens de validação
        icm_validation_messages.classList.add('d-none');
        icm_validation_messages__title.innerHTML = "";
        icm_validation_messages__message.textContent = "";

        // Frescuras visuais
        forgot_password__form__btn.value = 'Carregando...';
        forgot_password__form__btn.disabled = true;

        // Validação do formulário
        let result = validation.run(forgot_password__form);

        if (!result.check) {
            // Exibe mensagem de validação
            icm_validation_messages.classList.remove('d-none');
            icm_validation_messages.classList.add('no-title');
            icm_validation_messages__message.innerHTML = result.data;

            // Atualiza token de validação de requisição
            axios.get(forgot_password__form__refresh.value).then((result_csrf) => {
                forgot_password__form__token.value = result_csrf.data.token

                // Frescuras visuais
                forgot_password__form__btn.value = 'Enviar';
                forgot_password__form__btn.disabled = false;
            });
        } else {
            // And here we go...
            axios.post(forgot_password__form.action, result.data, {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }).then((result) => {
                if (result.data.status === 201) {                
                    window.location.href = forgot_password__form__redirect.value;
                } else {
    
                    // Exibe mensagem de validação
                    icm_validation_messages.classList.remove('d-none');
                    icm_validation_messages__title.innerHTML = "Usuário não encontrado! <small class='icm_validation_messages__code'>(Cód.: " + result.data.status + ")</small>";
                    icm_validation_messages__message.append(result.data.message);
    
                    // Atualiza token de validação de requisição
                    axios.get(forgot_password__form__refresh.value).then((result_csrf) => {
                        forgot_password__form__token.value = result_csrf.data.token
    
                        // Frescuras visuais
                        forgot_password__form__btn.value = 'Enviar';
                        forgot_password__form__btn.disabled = false;
                    });
                }
            });
        }
    });
}