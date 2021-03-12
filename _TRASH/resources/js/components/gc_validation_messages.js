'use strict';

const icm_validation_messages = document.querySelector('.icm_validation_messages');

if (icm_validation_messages != null) {
    
    const icm_validation_messages__close = icm_validation_messages.querySelector(".icm_validation_messages__close"),
        icm_validation_messages__title = icm_validation_messages.querySelector(".icm_validation_messages__title"),
        icm_validation_messages__message = icm_validation_messages.querySelector(".icm_validation_messages__message");

    // Botão "Fechar"
    icm_validation_messages__close.addEventListener('click', function(e) {
        e.preventDefault();

        icm_validation_messages.classList.add('d-none');
        icm_validation_messages__title.innerHTML = "";
        icm_validation_messages__message.textContent = "";
    });

}