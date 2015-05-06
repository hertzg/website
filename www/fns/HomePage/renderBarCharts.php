<?php

namespace HomePage;

function renderBarCharts ($user, &$items) {

    if (!$user->show_bar_charts) return;

    $fnsDir = __DIR__.'/..';

    $num_bar_charts = $user->num_bar_charts;

    $title = 'Bar Charts';
    $href = '../bar-charts/';
    $icon = 'bar-charts';
    $options = ['id' => 'bar-charts'];
    if ($num_bar_charts) {

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            "$num_bar_charts total.", $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['bar-charts'] = $link;

}
