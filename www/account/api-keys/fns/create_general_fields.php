<?php

function create_general_fields ($values) {
    $fnsDir = __DIR__.'/../../../fns';
    include_once "$fnsDir/Form/textfield.php";
    include_once __DIR__.'/create_expires_field.php';
    return
        Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_expires_field($values['expires']);
}
