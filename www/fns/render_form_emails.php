<?php

function render_form_emails ($contact, &$items) {

    $email1 = $contact->email1;
    $email2 = $contact->email2;

    $render = function ($email, $label) {
        $value = htmlspecialchars($email);
        if ($label !== '') $value .= ' ('.htmlspecialchars($label).')';
        return $value;
    };

    if ($email1 === '') {
        if ($email2 !== '') {
            $value = $render($email2, $contact->email2_label);
            include_once __DIR__.'/Form/label.php';
            $items[] = \Form\label('Email', $value);
        }
    } else {
        $value = $render($email1, $contact->email1_label);
        include_once __DIR__.'/Form/label.php';
        if ($email2 === '') {
            $item = \Form\label('Email', $value);
        } else {
            $value .= '<br />'.$render($email2, $contact->email2_label);
            $item = \Form\label('Email', $value);
        }
        $items[] = $item;
    }

}
