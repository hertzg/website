<?php

namespace SearchPage;

function renderBarCharts ($bar_charts, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($bar_charts) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($bar_charts as $bar_chart) {

            $id = $bar_chart->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );

            $name = $bar_chart->name;
            $escapedName = htmlspecialchars($name);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedName);

            $items[] = \Page\imageArrowLink($title,
                "../view/?$queryString", 'bar-chart');

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No bar charts found');
    }

}
