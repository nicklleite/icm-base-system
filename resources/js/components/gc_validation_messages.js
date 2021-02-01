'use strict';

const gc_validation_messages = document.querySelector('.gc_validation_messages');

if (gc_validation_messages != null) {
    
    const gc_validation_messages__close = gc_validation_messages.querySelector(".gc_validation_messages__close"),
        gc_validation_messages__title = gc_validation_messages.querySelector(".gc_validation_messages__title"),
        gc_validation_messages__message = gc_validation_messages.querySelector(".gc_validation_messages__message");

    // Botão "Fechar"
    gc_validation_messages__close.addEventListener('click', function(e) {
        e.preventDefault();

        gc_validation_messages.classList.add('d-none');
        gc_validation_messages__title.innerHTML = "";
        gc_validation_messages__message.textContent = "";
    });

}