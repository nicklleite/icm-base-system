'use strict';

// Atualização em massa de registros

const icm_filters__mass_update = document.querySelector('.icm_filters__mass_update');

if (icm_filters__mass_update != null) {

    var icm_filters__mass_update__token = icm_filters__mass_update.querySelector('[name=csrf_token]'),
        icm_filters__mass_update__status = icm_filters__mass_update.querySelector('[name=icm_filters__mass_update__status]'),
        icm_filters__mass_update__delete = icm_filters__mass_update.querySelector('[name=icm_filters__mass_update__delete]'),
        icm_data_table__checkboxes = document.getElementsByName('icm_data_table__select');

    // Exibir opções
    var selectAll = function(element) {
        if (icm_filters__mass_update.classList.contains('d-none')) {
            icm_filters__mass_update.classList.remove('d-none');
        } else {
            icm_filters__mass_update.classList.add('d-none');
        }

        for(var i = 0, n = icm_data_table__checkboxes.length; i < n; i++) {
            icm_data_table__checkboxes[i].checked = element.checked;
        }
    }

    icm_filters__mass_update__status.addEventListener('click', function(e) {
        e.preventDefault();

        var data = {
            "csrf_token": icm_filters__mass_update__token.value,
            "action": this.dataset.action,
            "ids": []
        }
        
        for (var i = 0; i < icm_data_table__checkboxes.length; i++) {
            data.ids.push(icm_data_table__checkboxes[i].dataset.userid);
        }

        data = new URLSearchParams(data);

        var result = mass_update(icm_filters__mass_update.action, data);
    });
}