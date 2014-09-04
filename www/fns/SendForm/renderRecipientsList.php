<?php

namespace SendForm;

function renderRecipientsList (array $recipients, array $params) {
    $html = '';
    include_once __DIR__.'/../Page/removableItem.php';
    foreach ($recipients as $recipient) {
        $username = htmlspecialchars($recipient);
        $href = 'remove-recipient/?'.htmlspecialchars(
            http_build_query(
                array_merge($params, ['username' => $recipient])
            )
        );
        $html .=
            \Page\removableItem($username, $href, 'user')
            .'<div class="hr"></div>';
    }
    return $html;
}
