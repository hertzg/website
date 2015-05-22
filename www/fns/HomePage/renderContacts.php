<?php

namespace HomePage;

function renderContacts ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_contact) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-contact'] = \Page\imageArrowLink(
            'New Contact', '../contacts/new/', 'create-contact');
    }

    if (!$user->show_contacts) return;

    $num_contacts = $user->num_contacts;
    $num_received_contacts = $user->num_received_contacts;

    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    $options = ['id' => 'contacts'];
    if ($num_contacts || $num_received_contacts) {

        $descriptions = [];
        if ($num_contacts) $descriptions[] = "$num_contacts total.";
        if ($num_received_contacts) {
            $descriptions[] = "$num_received_contacts received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['contacts'] = $link;
}
