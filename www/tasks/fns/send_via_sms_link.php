<?php

function send_via_sms_link ($task) {

    $body = $task->text;
    $deadline_time = $task->deadline_time;
    if ($deadline_time !== null) {
        $body .= "\nDeadline ".date('F j, Y', $deadline_time);
    }

    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return Page\imageLink('Send via SMS',
        'sms:?body='.rawurlencode($body), 'send-sms');

}
