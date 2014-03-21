<?php

function render_prev_button ($offset, $limit, $total, array &$items, $tag) {
    if ($offset) {

        $args = [];
        if ($tag !== '') $args['tag'] = $tag;

        include_once __DIR__.'/../../fns/Paging/prevButton.php';
        $items[] = Paging\prevButton($offset, $limit, $total, 'Tasks', $args);

    }
}
