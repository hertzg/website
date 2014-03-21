<?php

function render_prev_button ($offset, $limit, $total,
    array &$items, $keyword, $tag) {

    if ($offset) {

        $args = [];
        if ($keyword !== '') $args['keyword'] = $keyword;
        if ($tag !== '') $args['tag'] = $tag;

        include_once __DIR__.'/../../../fns/Paging/prevButton.php';
        $items[] = Paging\prevButton($offset, $limit, $total, 'Notes', $args);

    }

}
