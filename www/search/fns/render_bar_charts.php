<?php

function render_bar_charts ($bar_charts, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/amount_html.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($bar_charts as $bar_chart) {

        $title = htmlspecialchars($bar_chart->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $query = "?id=$bar_chart->id&amp;keyword=$encodedKeyword";
        $href = "../bar-charts/view/$query";

        $items[] = Page\imageArrowLink($title, $href, 'bar-chart');

    }

}
