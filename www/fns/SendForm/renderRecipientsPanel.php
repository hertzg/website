<?php

namespace SendForm;

function renderRecipientsPanel (array $recipients, array $params) {

    $sendHref = "submit-send.php?".htmlspecialchars(http_build_query($params));

    include_once __DIR__.'/renderRecipientsList.php';
    include_once __DIR__.'/../Page/buttonLink.php';
    return
        renderRecipientsList($recipients, $params)
        .\Page\buttonLink('Send', $sendHref);

}
