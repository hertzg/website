<?php

function render_bar_charts ($bar_charts, &$items, $params, $base) {

    $fnsDir = __DIR__.'/../../fns';

    if ($bar_charts) {

        include_once "$fnsDir/create_bar_chart_link.php";
        foreach ($bar_charts as $bar_chart) {

            $id = $bar_chart->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $title = htmlspecialchars($bar_chart->name);
            $items[] = create_bar_chart_link($title,
                $bar_chart->tags_json, $href, ['id' => $id], true);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No bar charts');
    }

}
