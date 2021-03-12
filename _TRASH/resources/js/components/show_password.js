const show_password_wrapper = document.querySelector('.show-password');

if (show_password_wrapper != null) {
    var fn_show_password = function(el) {

        let btn = el,
            input = el.previousElementSibling,
            icon = el.children[1],
            label = el.children[0];

        if (icon.classList.contains('fa-eye')) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');

            input.setAttribute('type', 'text');

            btn.setAttribute('aria-expanded', true);
            label.innerText = 'Esconder Senha';
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');

            input.setAttribute('type', 'password');

            btn.setAttribute('aria-expanded', false);
            label.innerText = 'Mostrar Senha';
        }
    }
}