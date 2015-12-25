<?php

function create_folder_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/FileName/maxLength.php";
    include_once "$fnsDir/Form/textfield.php";
    return Form\textfield('name', 'Folder name', [
        'value' => $values['name'],
        'maxlength' => FileName\maxLength(),
        'autofocus' => true,
        'required' => true,
    ]);

}
