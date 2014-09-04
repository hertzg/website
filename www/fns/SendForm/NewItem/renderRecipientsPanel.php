<?php

namespace SendForm\NewItem;

function renderRecipientsPanel (array $recipients, array $params) {

    $html = '';
    include_once __DIR__.'/../../Page/imageLink.php';
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

    $href = 'submit-send.php';
    if ($params) $href .= '?'.htmlspecialchars(http_build_query($params));

    include_once __DIR__.'/../../Page/buttonLink.php';
    $html .= \Page\buttonLink('Send', $href);

    return $html;

}
