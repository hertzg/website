<?php

function render_bar_charts ($bar_charts, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_bar_charts = count($bar_charts);
    if ($total > $groupLimit) array_pop($bar_charts);

    include_once "$fnsDir/create_bar_chart_link.php";
    foreach ($bar_charts as $bar_chart) {

        $title = htmlspecialchars($bar_chart->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $query = "?id=$bar_chart->id&amp;keyword=$encodedKeyword";
        $href = "../bar-charts/view/$query";

        $items[] = create_bar_chart_link($title, $bar_chart->tags_json, $href);

    }

    if ($num_bar_charts < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Bar Charts",
            "../bar-charts/search/?keyword=$encodedKeyword", 'bar-charts');
    }

}
