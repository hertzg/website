<?php

function render_notes ($user, array &$items) {
    $num_notes = $user->num_notes;
    $title = 'Notes';
    $href = '../notes/';
    $icon = 'notes';
    if ($num_notes) {
        $description = "$num_notes total.";
        $items[] = Page::imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        $items[] = Page::imageArrowLink($title, $href, $icon);
    }
}
