<?php

function render_contacts (array $contacts, array &$items) {
    if ($contacts) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        foreach ($contacts as $contact) {
            $title = htmlspecialchars($contact->fullname);
            $href = "../contacts/view/?id=$contact->idcontacts";
            $items[] = Page\imageArrowLink($title, $href, 'contact');
        }
    }
}
