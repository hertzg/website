<?php

function contact_sms_text ($contact) {

    $text = $contact->full_name;

    $alias = $contact->alias;
    if ($alias !== '') $text .= " ($alias)";

    $address = $contact->address;
    if ($address !== '') $text .= "\n$address";

    $email1 = $contact->email1;
    if ($email1 !== '') $text .= "\n$email1";

    $email2 = $contact->email2;
    if ($email2 !== '') $text .= "\n$email2";

    $phone1 = $contact->phone1;
    if ($phone1 !== '') $text .= "\n$phone1";

    $phone2 = $contact->phone2;
    if ($phone2 !== '') $text .= "\n$phone2";

    return $text;

}
