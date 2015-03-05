<?php

namespace SearchPage;

function renderNextButton ($offset, $limit, $total, &$items, $keyword, $tag) {

    if ($offset + $limit >= $total) return;

    $args = [];
    if ($keyword !== '') $args['keyword'] = $keyword;
    if ($tag !== '') $args['tag'] = $tag;

    include_once __DIR__.'/../../../fns/Paging/nextButton.php';
    $items[] = \Paging\nextButton($offset, $limit, 'Schedules', $args);

}
