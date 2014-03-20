<?php

function render_next_button ($offset, $limit, $total,
    array &$items, $keyword, $tag) {

    if ($offset + $limit < $total) {

        $args = [];
        if ($keyword !== '') $args['keyword'] = $keyword;
        if ($tag !== '') $args['tag'] = $tag;

        include_once __DIR__.'/../../../fns/Paging/nextButton.php';
        $items[] = Paging\nextButton($offset, $limit, 'Notes', $args);

    }

}
