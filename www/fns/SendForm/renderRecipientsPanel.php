<?php

namespace SendForm;

function renderRecipientsPanel ($recipients, $params, $base = '') {

    $query = '?'.htmlspecialchars(http_build_query($params));
    $sendHref = "{$base}submit-send.php$query";

    include_once __DIR__.'/renderRecipientsList.php';
    include_once __DIR__.'/../Page/buttonLink.php';
    return
        renderRecipientsList($recipients, $params, $base)
        .\Page\buttonLink('Send', $sendHref);

}
