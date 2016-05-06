<?php

function render_contacts ($contacts, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($contacts) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($contacts as $contact) {

            $id = $contact->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $alias = htmlspecialchars($contact->alias);
            $title = htmlspecialchars($contact->full_name);
            $icon = 'none';

            $photo_id = $contact->photo_id;
            if ($photo_id === null) {
                $image = "{$base}../images/empty-photo.svg";
            } else {
                $image = "{$base}photo/download/?id=$id&amp;photo_id=$photo_id";
            }
            $options['image'] = $image;

            if ($alias === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon, $options);
            } else {
                $items[] = Page\imageArrowLinkWithDescription(
                    $title, $alias, $href, $icon, $options);
            }

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No contacts');
    }

}
