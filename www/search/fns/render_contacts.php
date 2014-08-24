<?php

function render_contacts (array $contacts, array &$items, $regex) {

    $replace = '<mark>$0</mark>';

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($contacts as $contact) {

        $title = htmlspecialchars($contact->full_name);
        $alias = htmlspecialchars($contact->alias);
        $phone1 = htmlspecialchars($contact->phone1);
        $phone2 = htmlspecialchars($contact->phone2);

        $title = preg_replace($regex, $replace, $title);
        $href = "../contacts/view/?id=$contact->id_contacts";

        if ($contact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        $descriptions = [];
        if ($alias !== '') {
            $descriptions[] = preg_replace($regex, $replace, $alias);
        }
        if (preg_match($regex, $phone1)) {
            $descriptions[] = preg_replace($regex, $replace, $phone1);
        }
        if (preg_match($regex, $phone2)) {
            $descriptions[] = preg_replace($regex, $replace, $phone2);
        }

        if ($descriptions) {
            $description = join(' &middot; ', $descriptions);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);
        } else {
            $items[] = Page\imageArrowLink($title, $href, $icon);
        }

    }
}
