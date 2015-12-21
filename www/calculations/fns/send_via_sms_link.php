<?php

function send_via_sms_link ($calculation, $expression) {

    $body = "$expression = ".number_format($calculation->value, 2);
    $title = $calculation->title;
    if ($title !== '') $body = "$title\n$body";

    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return \Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($body), 'send-sms');

}
