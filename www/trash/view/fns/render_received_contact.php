<?php

function render_received_contact ($contact, &$items, &$infoText) {

    include_once __DIR__.'/../../../fns/Form/label.php';
    $items[] = Form\label('Full name', $contact->full_name);

    $alias = $contact->alias;
    if ($alias !== '') $items[] = Form\label('Alias', $alias);

    $address = $contact->address;
    if ($address !== '') $items[] = Form\label('Address', $address);

    $email = $contact->email;
    if ($email !== '') $items[] = Form\label('Email', $email);

    $phone1 = $contact->phone1;
    if ($phone1 !== '') $items[] = Form\label('Phone 1', $phone1);

    $phone2 = $contact->phone2;
    if ($phone2 !== '') $items[] = Form\label('Phone 2', $phone2);

    $birthday_time = $contact->birthday_time;
    if ($birthday_time !== null) {
        $items[] = Form\label('Birthday', date('F d, Y', $birthday_time));
    }

    $username = $contact->username;
    if ($username !== '') {
        $items[] = Form\label('Username', $username);
    }

    $tags = $contact->tags;
    if ($tags !== '') $items[] = Form\label('Tags', $tags);

    $priority = $contact->favorite ? 'Favorite' : 'Regular';
    $infoText = "$priority contact.</br>$infoText";

}
