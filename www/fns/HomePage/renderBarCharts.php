<?php

namespace HomePage;

function renderBarCharts ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_bar_chart) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-bar-chart'] = \Page\imageArrowLink(
            'New Bar Chart', '../bar-charts/new/', 'create-bar-chart');
    }

    if (!$user->show_bar_charts) return;

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
