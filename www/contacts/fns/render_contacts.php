<?php

function render_contacts (array $contacts, array &$items, $base = '') {
    if ($contacts) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($contacts as $contact) {
            $title = htmlspecialchars($contact->fullname);
            $href = "{$base}view/?id=$contact->idcontacts";
            $items[] = Page\imageArrowLink($title, $href, 'contact');
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No contacts.');
    }
}
