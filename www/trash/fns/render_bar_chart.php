<?php

function render_bar_chart ($bar_chart, $description, $href, $options, &$items) {
    $items[] = Page\imageArrowLinkWithDescription(
        htmlspecialchars($bar_chart->name), $description,
        $href, 'bar-chart', $options);
}
