<?php

function create_point_form_items ($values) {

    $focus = $values['focus'];

    include_once __DIR__.'/../../fns/Form/textfield.php';
    return
        Form\textfield('latitude', 'Latitude', [
            'value' => $values['latitude'],
            'autofocus' => $focus === 'latitude',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('longitude', 'Longitude', [
            'value' => $values['longitude'],
            'autofocus' => $focus === 'longitude',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('altitude', 'Altitude', [
            'value' => $values['altitude'],
        ]);

}
