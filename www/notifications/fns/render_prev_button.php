<?php

function render_prev_button ($offset, $limit,
    $total, &$items, $params = [], $base = '') {

    if (!$offset) return;

    include_once __DIR__.'/../../fns/Paging/prevButton.php';
    $items[] = Paging\prevButton($offset,
        $limit, $total, 'Notifications', $params, $base);

}
