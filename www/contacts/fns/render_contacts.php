<?php

function render_contacts (array $contacts, array &$items, array $params) {

    if ($contacts) {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        foreach ($contacts as $contact) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $contact->id_contacts], $params)
                )
            );
            $href = "view/?$queryString";

            $alias = $contact->alias;
            $title = htmlspecialchars($contact->full_name);

            if ($contact->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            if ($alias === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            } else {
                $items[] = Page\imageArrowLinkWithDescription($title, $alias,
                    $href, $icon);
            }

        }
    } else {
        include_once __DIR__.'/../../fns/Page/info.php';
        $items[] = Page\info('No contacts');
    }

}
