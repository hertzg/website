<?php

function render_contact ($id, $contact, &$title, &$icon, &$options) {

    $title = htmlspecialchars($contact->full_name);

    $photo_id = $contact->photo_id;
    if ($photo_id !== null) $options['image'] = "download-photo/?id=$id";

    if ($contact->favorite) $icon = 'favorite-contact';
    else $icon = 'contact';

}
