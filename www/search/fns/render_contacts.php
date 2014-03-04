<?php

function render_contacts (array $contacts, array &$items) {
    foreach ($contacts as $contact) {
        $title = htmlspecialchars($contact->fullname);
        $href = "../contacts/view/?id=$contact->idcontacts";
        $items[] = Page::imageArrowLink($title, $href, 'contact');
    }
}
