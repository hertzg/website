<?php

function send_via_sms_link ($note) {
    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return \Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($note->text), 'send-sms');
}
