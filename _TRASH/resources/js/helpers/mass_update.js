'use strict';

function mass_update(form_action, data) {

    if (form_action == null || data == null) {
        return false;
    }

    console.log(data);

    axios.post(form_action, data, {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
    }).then(function(result) {
        console.log(result);
    });

}