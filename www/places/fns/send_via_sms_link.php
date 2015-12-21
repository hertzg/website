<?php

function send_via_sms_link ($place) {

    $body = '';
    $name = $place->name;
    if ($name !== '') {
        $body .= $name;
        $description = $place->description;
        if ($description !== '') $body .= " ($description)";
        $body .= "\n";
    }
    $body .= "$place->latitude, $place->longitude";

    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($body), 'send-sms');

}
