<?php

function render_next_button ($offset, $limit, $total,
    array &$items, $keyword, $searchFiles) {

    if ($offset + $limit < $total) {

        $args = [];
        if ($keyword !== '') $args['keyword'] = $keyword;
        if ($searchFiles) $args['files'] = 1;

        include_once __DIR__.'/../../fns/Paging/nextButton.php';
        $items[] = Paging\nextButton($offset, $limit, 'Items', $args);

    }

}
