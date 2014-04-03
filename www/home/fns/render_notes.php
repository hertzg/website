<?php

function render_notes ($user, array &$items) {

    if (!$user->show_notes) return;

    $num_notes = $user->num_notes;
    $num_received_notes = $user->num_received_notes;

    $key = 'notes';
    $title = 'Notes';
    $href = '../notes/';
    $icon = 'notes';
    if ($num_notes || $num_received_notes) {

        $descriptionItems = [];
        if ($num_notes) {
            $descriptionItems[] = "$num_notes total.";
        }
        if ($num_received_notes) {
            $descriptionItems[] = "$num_received_notes received.";
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
