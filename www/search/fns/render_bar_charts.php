<?php

function render_bar_charts ($bar_charts, &$items, $regex, $encodedKeyword) {
    include_once __DIR__.'/../../fns/create_bar_chart_link.php';
    foreach ($bar_charts as $bar_chart) {

        $title = htmlspecialchars($bar_chart->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $query = "?id=$bar_chart->id&amp;keyword=$encodedKeyword";
        $href = "../bar-charts/view/$query";

        $items[] = create_bar_chart_link($title, $bar_chart->tags, $href);

    }
}
