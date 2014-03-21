<?php

function render_contacts (array $contacts, array &$items) {
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($contacts as $contact) {
        $alias = $contact->alias;
        $title = htmlspecialchars($contact->full_name);
        $href = "../contacts/view/?id=$contact->idcontacts";
        $icon = 'contact';
        if ($alias === '') {
            $items[] = Page\imageArrowLink($title, $href, $icon);
        } else {
            $items[] = Page\imageArrowLinkWithDescription($title, $alias,
                $href, $icon);
        }
    }
}
