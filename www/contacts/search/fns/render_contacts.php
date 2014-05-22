<?php

function render_contacts (array $contacts,
    array &$items, array $params, $keyword) {

    $fnsPageDir = __DIR__.'/../../../fns/Page';

    if ($contacts) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword)).')+/i';

        include_once "$fnsPageDir/imageArrowLink.php";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        foreach ($contacts as $contact) {

            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $contact->id_contacts], $params)
                )
            );
            $href = "../view/?$queryString";

            $alias = $contact->alias;
            $title = htmlspecialchars($contact->full_name);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            if ($contact->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            if ($alias === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            } else {
                $alias = preg_replace($regex, '<mark>$0</mark>', $alias);
                $items[] = Page\imageArrowLinkWithDescription(
                    $title, $alias, $href, $icon);
            }

        }

    } else {
        include_once "$fnsPageDir/info.php";
        $items[] = Page\info('No contacts found');
    }

}
