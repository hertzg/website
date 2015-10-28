<?php

function render_prev_button ($offset, $limit, $total, &$items, $keyword) {

    if (!$offset) return;

    $args = [];
    if ($keyword !== '') $args['keyword'] = $keyword;

    include_once __DIR__.'/../../fns/Paging/prevButton.php';
    $items[] = Paging\prevButton($offset, $limit, $total, 'Items', $args);

}
