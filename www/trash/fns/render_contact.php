<?php

function render_contact ($id, $contact, &$title, &$icon, &$options) {

    $title = htmlspecialchars($contact->full_name);

    $photo_id = $contact->photo_id;
    if ($photo_id === null) $image = "../images/empty-photo.svg";
    else $image = "download-photo/?id=$id";
    $options['image'] = $image;

    $icon = 'none';

}
