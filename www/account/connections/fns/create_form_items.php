<?php

function create_form_items ($values, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('formCheckbox', '../../../');

    $username = $values['username'];
    $address = $values['address'];
    if ($address !== null) $username .= "@$address";

    include_once "$fnsDir/create_expires_field.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/UsernameAddress/maxLength.php";
    $items = [
        Form\textfield('username', 'Username', [
            'value' => $username,
            'maxlength' => UsernameAddress\maxLength(),
            'required' => true,
            'autofocus' => true,
        ]),
        create_expires_field($values['expires']),
    ];

    include_once __DIR__.'/render_checkbox_items.php';
    render_checkbox_items($values, $items);

    return join('<div class="hr"></div>', $items);

}
