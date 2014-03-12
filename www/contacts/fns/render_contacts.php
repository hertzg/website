<?php

function render_contacts (array $contacts, array &$items, $emptyMessage,
    $base = '') {

    if ($contacts) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        foreach ($contacts as $contact) {
            $alias = $contact->alias;
            $title = htmlspecialchars($contact->fullname);
            $href = "{$base}view/?id=$contact->idcontacts";
            $icon = 'contact';
            if ($alias === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            } else {
                $items[] = Page\imageArrowLinkWithDescription($title, $alias,
                    $href, $icon);
            }
        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info($emptyMessage);
    }

}
