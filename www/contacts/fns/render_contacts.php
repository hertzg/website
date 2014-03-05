<?php

function render_contacts (array $contacts, array &$items) {
    if ($contacts) {
        foreach ($contacts as $contact) {
            $title = htmlspecialchars($contact->fullname);
            $href = "view/?id=$contact->idcontacts";
            $items[] = Page::imageArrowLink($title, $href, 'contact');
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No contacts.');
    }
}
