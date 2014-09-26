<?php

function render_contacts ($contacts, &$items, $params, $base = '') {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    if ($contacts) {
        include_once "$fnsPageDir/imageArrowLink.php";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        foreach ($contacts as $contact) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $contact->id_contacts], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $alias = htmlspecialchars($contact->alias);
            $title = htmlspecialchars($contact->full_name);

            if ($contact->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            if ($alias === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            } else {
                $items[] = Page\imageArrowLinkWithDescription(
                    $title, $alias, $href, $icon);
            }

        }
    } else {
        include_once "$fnsPageDir/info.php";
        $items[] = Page\info('No contacts');
    }

}
