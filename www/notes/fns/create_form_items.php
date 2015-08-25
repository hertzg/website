<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Notes/maxLengths.php";
    $maxLengths = Notes\maxLengths();

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('encrypt_in_listings',
            'Encrypt in listings', $values['encrypt_in_listings'])
        .'<div class="hr"></div>'
        .Form\checkbox('password_protect',
            'Password protect', $values['password_protect']);

}
