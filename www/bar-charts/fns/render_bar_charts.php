<?php

function render_bar_charts ($bar_charts, &$items, $params, $base) {

    $fnsDir = __DIR__.'/../../fns';

    if ($bar_charts) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($bar_charts as $bar_chart) {

            $id = $bar_chart->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $items[] = Page\imageArrowLink(htmlspecialchars($bar_chart->name),
                $href, 'bar-chart', ['id' => $id]);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No bar charts');
    }

}
