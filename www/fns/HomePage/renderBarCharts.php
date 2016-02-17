<?php

namespace HomePage;

function renderBarCharts ($user) {

    $fnsDir = __DIR__.'/..';

    $num_bar_charts = $user->num_bar_charts;

    $title = 'Bar Charts';
    $href = '../bar-charts/';
    $icon = 'bar-charts';
    $options = ['id' => 'bar-charts'];

    if ($num_bar_charts) {
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription($title,
            "$num_bar_charts total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
