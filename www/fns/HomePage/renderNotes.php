<?php

namespace HomePage;

function renderNotes ($user, &$items) {

    if (!$user->show_notes) return;

    $fnsDir = __DIR__.'/..';

    $num_notes = $user->num_notes;
    $num_received_notes = $user->num_received_notes;

    $title = 'Notes';
    $href = '../notes/';
    $icon = 'notes';
    if ($num_notes || $num_received_notes) {

        $descriptionItems = [];
        if ($num_notes) $descriptionItems[] = "$num_notes total.";
        if ($num_received_notes) {
            $descriptionItems[] = "$num_received_notes received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon);
    }

    $items['notes'] = $link;

}