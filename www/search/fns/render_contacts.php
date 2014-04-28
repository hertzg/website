<?php

function render_contacts (array $contacts, array &$items, $regex) {

    $replace = '<mark>$0</mark>';

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($contacts as $contact) {

        $alias = $contact->alias;
        $title = htmlspecialchars($contact->full_name);
        $title = preg_replace($regex, $replace, $title);
        $href = "../contacts/view/?id=$contact->id_contacts";

        if ($contact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        if ($alias === '') {
            $items[] = Page\imageArrowLink($title, $href, $icon);
        } else {
            $alias = preg_replace($regex, $replace, $alias);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $alias, $href, $icon);
        }

    }
}
