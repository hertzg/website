<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Invitations/maxLengths.php";
    return
        Form\textfield('note', 'Note', [
            'value' => $values['note'],
            'maxlength' => Invitations\maxLengths()['note'],
            'autofocus' => true,
        ])
        .Form\notes(['Optional.']);

}
