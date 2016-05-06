<?php

namespace SearchPage;

function renderContacts ($contacts, &$items, $params, $includes) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($contacts) {

        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);

        $replace = '<mark>$0</mark>';

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($contacts as $contact) {

            $id = $contact->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($contact->full_name);
            $alias = htmlspecialchars($contact->alias);
            $email1 = htmlspecialchars($contact->email1);
            $email2 = htmlspecialchars($contact->email2);
            $phone1 = htmlspecialchars($contact->phone1);
            $phone2 = htmlspecialchars($contact->phone2);

            $title = preg_replace($regex, $replace, $title);
            $icon = 'none';

            $descriptions = [];
            if ($alias !== '') {
                $descriptions[] = preg_replace($regex, $replace, $alias);
            }
            if (preg_match($regex, $email1)) {
                $descriptions[] = preg_replace($regex, $replace, $email1);
            }
            if (preg_match($regex, $email2)) {
                $descriptions[] = preg_replace($regex, $replace, $email2);
            }
            if (preg_match($regex, $phone1)) {
                $descriptions[] = preg_replace($regex, $replace, $phone1);
            }
            if (preg_match($regex, $phone2)) {
                $descriptions[] = preg_replace($regex, $replace, $phone2);
            }

            $photo_id = $contact->photo_id;
            if ($photo_id === null) $image = "../../images/empty-photo.svg";
            else $image = "../photo/download/?id=$id&amp;photo_id=$photo_id";

            $options = [
                'id' => $id,
                'image' => $image,
            ];

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
