<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    $username = $values['username'];
    $address = $values['address'];
    if ($address !== null) $username .= "@$address";

    include_once "$fnsDir/create_expires_field.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Username/maxLength.php";
    $items = [
        Form\textfield('username', 'Username', [
            'value' => $username,
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ]),
        create_expires_field($values['expires']),
    ];

    include_once __DIR__.'/render_checkbox_items.php';
    render_checkbox_items($values, $items);

    return join('<div class="hr"></div>', $items);

}
