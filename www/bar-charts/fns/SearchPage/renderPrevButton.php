<?php

namespace SearchPage;

function renderPrevButton ($offset, $limit, $total, &$items, $args) {

    if (!$offset) return;

    include_once __DIR__.'/../../../fns/Paging/prevButton.php';
    $items[] = \Paging\prevButton($offset, $limit, $total, 'Bar Charts', $args);

}
