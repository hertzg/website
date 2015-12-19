<?php

function render_bar_chart ($bar_chart, &$title, &$icon) {
    $title = htmlspecialchars($bar_chart->name);
    $icon = 'bar-chart';
}
