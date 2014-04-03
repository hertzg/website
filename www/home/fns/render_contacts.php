<?php

function render_contacts ($user, array &$items) {

    if (!$user->show_contacts) return;

    $num_contacts = $user->num_contacts;
    $num_received_contacts = $user->num_received_contacts;

    $key = 'contacts';
    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    if ($num_contacts || $num_received_contacts) {

        $descriptionItems = [];
        if ($num_contacts) {
            $descriptionItems[] = "$num_contacts total.";
        }
        if ($num_received_contacts) {
            $descriptionItems[] = "$num_received_contacts received.";
        }
        $description = join(' ', $descriptionItems);

        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
