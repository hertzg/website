<?php

function sendViaSmsLink ($bookmark) {

    $href = 'sms:?body=';
    $title = $bookmark->title;
    if ($title !== '') $href .= rawurlencode("$title\n");
    $href .= rawurlencode($bookmark->url);

    include_once __DIR__.'/../../fns/Page/imageLink.php';
    return \Page\imageLink('Send via SMS', $href, 'send-sms');

}
