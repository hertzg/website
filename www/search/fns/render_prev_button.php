<?php

function render_prev_button ($offset, $limit,
    array &$items, $keyword, $searchFiles) {

    if ($offset) {

        $args = [];
        if ($keyword !== '') $args['keyword'] = $keyword;
        if ($searchFiles) $args['files'] = 1;

        include_once __DIR__.'/../../fns/Paging/prevButton.php';
        $items[] = Paging\prevButton($offset, $limit, 'Items', $args);

    }

}
