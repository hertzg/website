<?php

function render_notes ($user, array &$items) {
    if ($user->show_notes) {
        $num_notes = $user->num_notes;
        $title = 'Notes';
        $href = '../notes/';
        $icon = 'notes';
        if ($num_notes) {
            $description = "$num_notes total.";
            include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon);
        } else {
            include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
            $items[] = Page\imageArrowLink($title, $href, $icon);
        }
    }
    if ($user->show_new_note) {
        $title = 'New Note';
        $href = '../notes/new/';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[] = Page\imageArrowLink($title, $href, 'create-note');
    }
}
