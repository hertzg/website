<?php

namespace RecipientList;

function contactsForm ($contacts, $params, $base = '') {
    $html = '';
    include_once __DIR__.'/../Page/imageLinkWithDescription.php';
    foreach ($contacts as $i => $contact) {

        if ($i) $html .= '<div class="hr"></div>';

        $contactUsername = $contact->username;
        $title = htmlspecialchars($contactUsername);
        $description = htmlspecialchars($contact->full_name);
        $params['username'] = $contactUsername;
        $query = '?'.htmlspecialchars(http_build_query($params));
        $href = "{$base}submit-add.php$query";

        if ($contact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        $html .= \Page\imageLinkWithDescription($title,
            $description, $href, $icon);

    }
    return $html;
}
