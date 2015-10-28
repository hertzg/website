<?php

function render_next_button ($offset, $limit, $total, &$items, $keyword) {

    if ($offset + $limit >= $total) return;

    $args = [];
    if ($keyword !== '') $args['keyword'] = $keyword;

    include_once __DIR__.'/../../fns/Paging/nextButton.php';
    $items[] = Paging\nextButton($offset, $limit, 'Items', $args);

}
