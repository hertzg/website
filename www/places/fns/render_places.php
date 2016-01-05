<?php

function render_places ($places, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($places) {

        include_once "$fnsDir/create_place_link.php";
        foreach ($places as $place) {

            $id = $place->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $items[] = create_place_link($place->latitude, $place->longitude,
                htmlspecialchars($place->name), $place->num_tags,
                $place->tags_json, $href, ['id' => $id], true);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No places');
    }

}
