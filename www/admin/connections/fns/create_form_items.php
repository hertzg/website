<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/create_expires_field.php";
    include_once "$fnsDir/ApiKey/length.php";
    include_once "$fnsDir/ConnectionAddress/maxLength.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('address', 'Address', [
            'value' => $values['address'],
            'maxlength' => ConnectionAddress\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_expires_field($values['expires'])
        .'<div class="hr"></div>'
        .Form\textarea('their_exchange_api_key', 'Their exchange API key', [
            'value' => $values['their_exchange_api_key'],
            'maxlength' => ApiKey\length(),
        ]);

}
