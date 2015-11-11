<?php

function create_email_form_items ($values, $maxLengths) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Email/maxLength.php";
    $emailMaxLength = Email\maxLength();

    include_once "$fnsDir/Form/textfieldWithLabel.php";
    return
        Form\textfieldWithLabel('email1', 'Email 1', [
            'value' => $values['email1'],
            'maxlength' => $emailMaxLength,
        ], [
            'value' => $values['email1_label'],
            'placeholder' => 'Note',
            'maxlength' => $maxLengths['email1_label'],
        ])
        .'<div class="hr"></div>'
        .Form\textfieldWithLabel('email2', 'Email 2', [
            'value' => $values['email2'],
            'maxlength' => $emailMaxLength,
        ], [
            'value' => $values['email2_label'],
            'placeholder' => 'Note',
            'maxlength' => $maxLengths['email2_label'],
        ]);

}
