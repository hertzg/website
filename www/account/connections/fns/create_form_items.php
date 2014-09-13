<?php

function create_form_items ($base, $values) {

    $fnsDir = __DIR__.'/../../../fns';
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Username/maxLength.php";
    $items = [
        Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ]),
    ];

    include_once __DIR__.'/render_checkbox_items.php';
    render_checkbox_items($base, $values, $items);

    return join('<div class="hr"></div>', $items);

}
