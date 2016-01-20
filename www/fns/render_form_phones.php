<?php

function render_form_phones ($contact, &$items) {

    $phone1 = $contact->phone1;
    $phone2 = $contact->phone2;

    $render = function ($phone, $label) {
        $value = htmlspecialchars($phone);
        if ($label !== '') $value .= ' ('.htmlspecialchars($label).')';
        return $value;
    };

    if ($phone1 === '') {
        if ($phone2 !== '') {
            $value = $render($phone2, $contact->phone2_label);
            include_once __DIR__.'/Form/label.php';
            $items[] = \Form\label('Phone', $value);
        }
    } else {
        $value = $render($phone1, $contact->phone1_label);
        include_once __DIR__.'/Form/label.php';
        if ($phone2 === '') {
            $item = \Form\label('Phone', $value);
        } else {
            $value .= '<br />'.$render($phone2, $contact->phone2_label);
            $item = \Form\label('Phone', $value);
        }
        $items[] = $item;
    }

}
