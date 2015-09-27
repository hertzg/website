<?php

function create_general_fields ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ApiKeyName/maxLength.php";
    include_once "$fnsDir/Form/textfield.php";
    return Form\textfield('name', 'Name', [
        'value' => $values['name'],
        'maxlength' => ApiKeyName\maxLength(),
        'required' => true,
        'autofocus' => true,
    ]);

}
