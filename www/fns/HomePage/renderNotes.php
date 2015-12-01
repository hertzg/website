<?php

namespace HomePage;

function renderNotes ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_note) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-note'] = \Page\thumbnailLink(
            'New Note', '../notes/new/', 'create-note');
    }

    if (!$user->show_notes) return;

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
        $link = \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['notes'] = $link;

}
