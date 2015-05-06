<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Wallets/maxLengths.php";
    $maxLengths = Wallets\maxLengths();

    include_once "$fnsDir/Form/textfield.php";
    return Form\textfield('name', 'Name', [
        'value' => $values['name'],
        'maxlength' => $maxLengths['name'],
        'autofocus' => true,
        'required' => true,
    ]);

}
