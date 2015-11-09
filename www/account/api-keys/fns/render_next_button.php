<?php

function render_next_button ($offset, $limit, $total, &$items) {

    if ($offset + $limit >= $total) return;

    include_once __DIR__.'/../../../fns/Paging/nextButton.php';
    $items[] = Paging\nextButton($offset, $limit, 'API Keys');

}
