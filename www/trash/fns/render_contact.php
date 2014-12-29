<?php

function render_contact ($contact, $description, $href, $options, &$items) {

    $title = htmlspecialchars($contact->full_name);

    if ($contact->favorite) $icon = 'favorite-contact';
    else $icon = 'contact';

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);

}
