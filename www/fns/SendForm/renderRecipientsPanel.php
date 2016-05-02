<?php

namespace SendForm;

function renderRecipientsPanel ($recipients, $params, $base = '') {

    $sendHref = "{$base}submit-send.php";
    if ($params) $sendHref .= '?'.htmlspecialchars(http_build_query($params));

    include_once __DIR__.'/renderRecipientsList.php';
    include_once __DIR__.'/../Form/linkButton.php';
    return
        renderRecipientsList($recipients, $params, $base)
        .\Form\linkButton('Send', $sendHref, true);

}
