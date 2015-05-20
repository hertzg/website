<?php

namespace SearchPage;

function renderNextButton ($offset, $limit, $total, &$items, $args) {

    if ($offset + $limit >= $total) return;

    include_once __DIR__.'/../../../fns/Paging/nextButton.php';
    $items[] = \Paging\nextButton($offset, $limit, 'Bar Charts', $args);

}
