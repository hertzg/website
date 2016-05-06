<?php

namespace RecipientList;

function contactsForm ($contacts, $params,
    $base, $contactsBase, $localBase = '') {

    $html = '';
    include_once __DIR__.'/../Page/imageLinkWithDescription.php';
    foreach ($contacts as $i => $contact) {

        if ($i) $html .= '<div class="hr"></div>';

        $contactUsername = $contact->username;
        $title = htmlspecialchars($contactUsername);
        $description = htmlspecialchars($contact->full_name);
        $params['username'] = $contactUsername;
        $query = '?'.htmlspecialchars(http_build_query($params));
        $href = "{$localBase}submit-add.php$query";

        $photo_id = $contact->photo_id;
        if ($photo_id === null) {
            $image = "{$base}images/empty-photo.svg";
        } else {
            $image = "{$contactsBase}photo/download/"
                ."?id=$contact->id&amp;photo_id=$photo_id";
        }

        $html .= \Page\imageLinkWithDescription($title,
            $description, $href, 'none', ['image' => $image]);

    }
    return $html;

}
