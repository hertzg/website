<?php

namespace SearchPage;

function renderPlaces ($user, $places, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($places) {

        include_once "$fnsDir/resolve_theme.php";
        resolve_theme($user, $theme_color, $theme_brightness);

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/create_place_link.php";
        foreach ($places as $place) {

            $id = $place->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $escapedName = htmlspecialchars($place->name);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedName);

            $items[] = create_place_link($theme_brightness,
                $place->latitude, $place->longitude, $title,
                $place->num_tags, $place->tags_json, $href, $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No places found');
    }

}
