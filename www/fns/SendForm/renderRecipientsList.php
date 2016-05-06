<?php

namespace SendForm;

function renderRecipientsList ($recipients, $params, $base = '') {
    $html = '';
    include_once __DIR__.'/../Page/removableItem.php';
    foreach ($recipients as $recipient) {
        $escapedUsername = htmlspecialchars($recipient);
        $query = '?'.htmlspecialchars(
            http_build_query(
                array_merge($params, ['username' => $recipient])
            )
        );
        $href = "{$base}remove-recipient/$query";
        $html .=
            "<div class=\"deleteLinkWrapper\" data-query=\"$query\""
            ." data-username=\"$escapedUsername\">"
                .\Page\removableItem($escapedUsername, $href, 'user')
            .'</div>'
            .'<div class="hr"></div>';
    }
    return $html;
}
