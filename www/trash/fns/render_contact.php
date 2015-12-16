<?php

function render_contact ($contact, &$title, &$icon) {

    $title = htmlspecialchars($contact->full_name);

    if ($contact->favorite) $icon = 'favorite-contact';
    else $icon = 'contact';

}
