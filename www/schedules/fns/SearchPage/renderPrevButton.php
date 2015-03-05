<?php

namespace SearchPage;

function renderPrevButton ($offset, $limit, $total, &$items, $keyword, $tag) {

    if (!$offset) return;

    $args = [];
    if ($keyword !== '') $args['keyword'] = $keyword;
    if ($tag !== '') $args['tag'] = $tag;

    include_once __DIR__.'/../../../fns/Paging/prevButton.php';
    $items[] = \Paging\prevButton($offset, $limit, $total, 'Schedules', $args);

}
