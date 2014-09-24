<?php

namespace SendForm;

function renderRecipientsList ($recipients, $params, $base= '') {
    $html = '';
    include_once __DIR__.'/../Page/removableItem.php';
    foreach ($recipients as $recipient) {
        $username = htmlspecialchars($recipient);
        $href = "{$base}remove-recipient/?".htmlspecialchars(
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
