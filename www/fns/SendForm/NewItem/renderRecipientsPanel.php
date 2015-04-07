<?php

namespace SendForm\NewItem;

function renderRecipientsPanel ($recipients, $params) {

    $sendHref = 'submit-send.php';
    if ($params) $sendHref .= '?'.htmlspecialchars(http_build_query($params));

    include_once __DIR__.'/../renderRecipientsList.php';
    include_once __DIR__.'/../../Page/buttonLink.php';
    return
        \SendForm\renderRecipientsList($recipients, $params)
        .\Page\buttonLink('Send', $sendHref);

}
