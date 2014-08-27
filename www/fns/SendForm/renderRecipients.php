<?php

namespace SendForm;

function renderRecipients (array $recipients, $params) {

    $html = '';
    include_once __DIR__.'/../Page/imageLink.php';
    foreach ($recipients as $recipient) {
        $username = htmlspecialchars($recipient);
        $href = 'remove-recipient/?'.htmlspecialchars(
            http_build_query(
                array_merge($params, ['username' => $recipient])
            )
        );
        $html .=
            \Page\imageLink($username, $href, 'contact')
            .'<div class="hr"></div>';
    }

    include_once __DIR__.'/../Page/buttonLink.php';
    $href = "submit-send.php?".htmlspecialchars(http_build_query($params));
    $html .= \Page\buttonLink('Send', $href);

    return $html;

}
