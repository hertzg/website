<?php

function render_prev_button ($offset, $limit,
    array &$items, $keyword, $tag) {

    if ($offset) {

        $args = [];
        if ($keyword !== '') $args['keyword'] = $keyword;
        if ($tag !== '') $args['tag'] = $tag;

        include_once __DIR__.'/../../../fns/Paging/prevButton.php';
        $items[] = Paging\prevButton($offset, $limit, 'Tasks', $args);

    }

}
