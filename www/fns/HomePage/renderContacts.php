<?php

namespace HomePage;

function renderContacts ($user, &$items) {

    if (!$user->show_contacts) return;

    $fnsDir = __DIR__.'/..';

    $num_contacts = $user->num_contacts;
    $num_received_contacts = $user->num_received_contacts;

    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    if ($num_contacts || $num_received_contacts) {

        $descriptionItems = [];
        if ($num_contacts) $descriptionItems[] = "$num_contacts total.";
        if ($num_received_contacts) {
            $descriptionItems[] = "$num_received_contacts received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon);
    }

    $items['contacts'] = $link;
}
