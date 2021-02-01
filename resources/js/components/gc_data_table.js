'use strict';

// Atualização em massa de registros

const gc_filters__mass_update = document.querySelector('.gc_filters__mass_update');

if (gc_filters__mass_update != null) {

    var gc_filters__mass_update__token = gc_filters__mass_update.querySelector('[name=csrf_token]'),
        gc_filters__mass_update__status = gc_filters__mass_update.querySelector('[name=gc_filters__mass_update__status]'),
        gc_filters__mass_update__delete = gc_filters__mass_update.querySelector('[name=gc_filters__mass_update__delete]'),
        gc_data_table__checkboxes = document.getElementsByName('gc_data_table__select');

    // Exibir opções
    var selectAll = function(element) {
        if (gc_filters__mass_update.classList.contains('d-none')) {
            gc_filters__mass_update.classList.remove('d-none');
        } else {
            gc_filters__mass_update.classList.add('d-none');
        }

        for(var i = 0, n = gc_data_table__checkboxes.length; i < n; i++) {
            gc_data_table__checkboxes[i].checked = element.checked;
        }
    }

    gc_filters__mass_update__status.addEventListener('click', function(e) {
        e.preventDefault();

        var data = {
            "csrf_token": gc_filters__mass_update__token.value,
            "action": this.dataset.action,
            "ids": []
        }
        
        for (var i = 0; i < gc_data_table__checkboxes.length; i++) {
            data.ids.push(gc_data_table__checkboxes[i].dataset.userid);
        }

        data = new URLSearchParams(data);

        var result = mass_update(gc_filters__mass_update.action, data);
    });
}