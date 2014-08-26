<?php

namespace RecipientList;

function contactsForm (array $contacts, array $params) {
    $items = [];
    include_once __DIR__.'/../Page/imageLinkWithDescription.php';
    foreach ($contacts as $contact) {

        $contactUsername = $contact->username;
        $title = htmlspecialchars($contactUsername);
        $description = htmlspecialchars($contact->full_name);
        $params['username'] = $contactUsername;
        $href = 'submit-add.php?'.htmlspecialchars(http_build_query($params));

        if ($contact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        $items[] = \Page\imageLinkWithDescription($title,
            $description, $href, $icon);

    }
    return join('<div class="hr"></div>', $items);
}
