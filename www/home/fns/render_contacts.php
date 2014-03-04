<?php

function render_contacts ($user, array &$items) {
    $num_contacts = $user->num_contacts;
    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    if ($num_contacts) {
        $description = "$num_contacts total.";
        $items[] = Page::imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        $items[] = Page::imageArrowLink($title, $href, $icon);
    }
}
