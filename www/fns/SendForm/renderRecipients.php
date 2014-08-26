<?php

namespace SendForm;

function renderRecipients (array $recipients, $itemParams, $escapedItemQuery) {

    $html = '';
    include_once __DIR__.'/../Page/imageLink.php';
    foreach ($recipients as $recipient) {
        $username = htmlspecialchars($recipient);
        $href = 'remove-recipient/?'.htmlspecialchars(
            http_build_query(
                array_merge($itemParams, ['username' => $recipient])
            )
        );
        $html .=
            \Page\imageLink($username, $href, 'contact')
            .'<div class="hr"></div>';
    }

    include_once __DIR__.'/../Page/buttonLink.php';
    $href = "submit-send.php$escapedItemQuery";
    $html .= \Page\buttonLink('Send', $href);

    return $html;

}
