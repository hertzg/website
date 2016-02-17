<?php

namespace HomePage;

function renderNotes ($user) {

    $fnsDir = __DIR__.'/..';

    $num_notes = $user->num_notes;
    $num_new_received = $user->num_received_notes -
        $user->num_archived_received_notes;

    $title = 'Notes';
    $href = '../notes/';
    $icon = 'notes';
    $options = ['id' => 'notes'];

    if ($num_notes || $num_new_received) {

        $descriptions = [];
        if ($num_notes) $descriptions[] = "$num_notes&nbsp;total.";
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
