<?php

namespace ViewPage;

function renderContactEmails ($contact, &$items) {

    $fnsDir = __DIR__.'/../../../fns';
    $email1 = $contact->email1;
    $email2 = $contact->email2;

    if ($email1 === '') {
        if ($email2 !== '') {
            include_once "$fnsDir/Form/label.php";
            $items[] = \Form\label('Email', htmlspecialchars($email2));
        }
    } else {
        $escapedEmail1 = htmlspecialchars($email1);
        include_once "$fnsDir/Form/label.php";
        if ($email2 === '') {
            $item = \Form\label('Email', $escapedEmail1);
        } else {
            $value = "$escapedEmail1<br />".htmlspecialchars($email2);
            $item = \Form\label('Email', $value);
        }
        $items[] = $item;
    }

}
