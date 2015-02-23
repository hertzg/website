<?php

function create_point_form_items ($values) {
    include_once __DIR__.'/../../fns/Form/textfield.php';
    return
        Form\textfield('latitude', 'Latitude', [
            'value' => $values['latitude'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('longitude', 'Longitude', [
            'value' => $values['longitude'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('altitude', 'Altitude', [
            'value' => $values['altitude'],
        ]);
}
