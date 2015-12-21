<?php

function send_via_sms_link ($contact) {

    $body = $contact->full_name;

    $alias = $contact->alias;
    if ($alias !== '') $body .= " ($alias)";

    $address = $contact->address;
    if ($address !== '') $body .= "\n$address";

    $email1 = $contact->email1;
    if ($email1 !== '') $body .= "\n$email1";

    $email2 = $contact->email2;
    if ($email2 !== '') $body .= "\n$email2";

    $phone1 = $contact->phone1;
    if ($phone1 !== '') $body .= "\n$phone1";

    $phone2 = $contact->phone2;
    if ($phone2 !== '') $body .= "\n$phone2";

    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return \Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($body), 'send-sms');

}
