<?php

namespace SearchPage;

function renderCalculations ($calculations, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($calculations) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/create_calculation_link.php";
        foreach ($calculations as $calculation) {

            $id = $calculation->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($calculation->title);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $items[] = create_calculation_link($title, $calculation->value,
                $calculation->tags_json, $href, ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No calculations found');
    }

}
