<?php

function send_via_sms_link ($contact) {

    $body = $contact->full_name;

    $add = function ($text, $label) use (&$body) {
        if ($text === '') return;
        $body .= "\n$text";
        if ($label !== '') $body .= " ($label)";
    };

    $alias = $contact->alias;
    if ($alias !== '') $body .= " ($alias)";

    $address = $contact->address;
    if ($address !== '') $body .= "\n$address";

    $add($contact->email1, $contact->email1_label);
    $add($contact->email2, $contact->email2_label);
    $add($contact->phone1, $contact->phone1_label);
    $add($contact->phone2, $contact->phone2_label);

    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return \Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($body), 'send-sms');

}
