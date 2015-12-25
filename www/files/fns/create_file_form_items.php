<?php

function create_file_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/FileName/maxLength.php";
    include_once "$fnsDir/Form/textfield.php";
    return Form\textfield('name', 'File name', [
        'value' => $values['name'],
        'maxlength' => FileName\maxLength(),
        'autofocus' => true,
        'required' => true,
    ]);

}
