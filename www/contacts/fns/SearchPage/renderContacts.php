<?php

namespace SearchPage;

function renderContacts ($contacts, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($contacts) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $replace = '<mark>$0</mark>';

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($contacts as $contact) {

            $id = $contact->id;
            $options = ['id' => "contact_$id"];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($contact->full_name);
            $alias = htmlspecialchars($contact->alias);
            $phone1 = htmlspecialchars($contact->phone1);
            $phone2 = htmlspecialchars($contact->phone2);

            $title = preg_replace($regex, $replace, $title);

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
                $items[] = \Page\imageArrowLinkWithDescription(
                    $title, $description, $href, $icon, $options);
            } else {
                $items[] = \Page\imageArrowLink($title, $href, $icon, $options);
            }

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No contacts found');
    }

}
