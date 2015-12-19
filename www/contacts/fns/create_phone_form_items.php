<?php

function create_phone_form_items ($values, $maxLengths) {
    include_once __DIR__.'/../../fns/Form/textfieldWithLabel.php';
    return
        Form\textfieldWithLabel('phone1', 'Phone 1', [
            'value' => $values['phone1'],
            'maxlength' => $maxLengths['phone'],
        ], [
            'value' => $values['phone1_label'],
            'placeholder' => 'Note',
            'maxlength' => $maxLengths['phone_label'],
        ])
        .'<div class="hr"></div>'
        .Form\textfieldWithLabel('phone2', 'Phone 2', [
            'value' => $values['phone2'],
            'maxlength' => $maxLengths['phone'],
        ], [
            'value' => $values['phone2_label'],
            'maxlength' => $maxLengths['phone_label'],
            'placeholder' => 'Note',
        ]);
}
