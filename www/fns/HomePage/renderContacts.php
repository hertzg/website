<?php

namespace HomePage;

function renderContacts ($user) {

    $fnsDir = __DIR__.'/..';

    $num_contacts = $user->num_contacts;
    $num_new_received = $user->num_received_contacts -
        $user->num_archived_received_contacts;

    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    $options = ['id' => 'contacts'];
    if ($num_contacts || $num_new_received) {

        $descriptions = [];
        if ($num_contacts) $descriptions[] = "$num_contacts&nbsp;total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
