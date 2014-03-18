<?php

function render_contacts ($user, array &$items) {

    if (!$user->show_contacts) return;

    $key = 'contacts';
    $num_contacts = $user->num_contacts;
    $title = 'Contacts';
    $href = '../contacts/';
    $icon = 'contacts';
    if ($num_contacts) {
        $description = "$num_contacts total.";
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
