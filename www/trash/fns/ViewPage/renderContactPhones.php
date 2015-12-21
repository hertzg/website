<?php

namespace ViewPage;

function renderContactPhones ($contact, &$items) {

    $fnsDir = __DIR__.'/../../../fns';
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
            include_once "$fnsDir/Form/label.php";
            $items[] = \Form\label('Phone', $value);
        }
    } else {
        $value = $render($phone1, $contact->phone1_label);
        include_once "$fnsDir/Form/label.php";
        if ($phone2 === '') {
            $item = \Form\label('Phone', $value);
        } else {
            $value .= '<br />'.$render($phone2, $contact->phone2_label);
            $item = \Form\label('Phone', $value);
        }
        $items[] = $item;
    }

}
