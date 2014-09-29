<?php

function render_next_button ($offset, $limit, $total, &$items, $tag) {

    if ($offset + $limit >= $total) return;

    $args = [];
    if ($tag !== '') $args['tag'] = $tag;

    include_once __DIR__.'/../../fns/Paging/nextButton.php';
    $items[] = Paging\nextButton($offset, $limit, 'Tasks', $args);

}
