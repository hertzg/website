<?php

namespace HomePage;

function renderContacts ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_contact) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-contact'] = \Page\thumbnailLink(
            'New Contact', '../contacts/new/', 'create-contact');
    }

    if (!$user->show_contacts) return;

    $num_contacts = $user->num_contacts;
    $num_new_received = $user->num_received_contacts -
        $user->num_archived_received_contacts;

    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    $options = ['id' => 'contacts'];
    if ($num_contacts || $num_new_received) {

        $descriptions = [];
        if ($num_contacts) $descriptions[] = "$num_contacts total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received new received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['contacts'] = $link;

}
