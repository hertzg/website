<?php

function render_prev_button ($offset, $limit, $total, &$items, $tag) {

    if (!$offset) return;

    $args = [];
    if ($tag !== '') $args['tag'] = $tag;

    include_once __DIR__.'/../../fns/Paging/prevButton.php';
    $items[] = Paging\prevButton($offset,
        $limit, $total, 'Bookmarks', $args);

}
