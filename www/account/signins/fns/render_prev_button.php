<?php

function render_prev_button ($offset, $limit, $total, &$items) {

    if (!$offset) return;

    include_once __DIR__.'/../../../fns/Paging/prevButton.php';
    $items[] = Paging\prevButton($offset, $limit, $total, 'Signins');

}
