<?php

namespace ViewPage;

function renderBarChart ($bar_chart, &$items) {
    include_once __DIR__.'/../../../fns/Form/label.php';
    $items[] = \Form\label('Name', htmlspecialchars($bar_chart->name));
}
