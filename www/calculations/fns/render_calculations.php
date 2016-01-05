<?php

function render_calculations ($calculations, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($calculations) {

        include_once "$fnsDir/create_calculation_link.php";
        foreach ($calculations as $calculation) {

            $id = $calculation->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $title = $calculation->title;
            if ($title === '') $title = $calculation->expression;
            $title = htmlspecialchars($title);

            $items[] = create_calculation_link($title, $calculation->value,
                $calculation->tags_json, $href, ['id' => $id], true);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No calculations');
    }

}
