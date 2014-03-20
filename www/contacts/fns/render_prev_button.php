<?php

function render_prev_button ($offset, $limit, array &$items, $tag) {
    if ($offset) {

        $args = [];
        if ($tag !== '') $args['tag'] = $tag;

        include_once __DIR__.'/../../fns/Paging/prevButton.php';
        $items[] = Paging\prevButton($offset, $limit, 'Contacts', $args);

    }
}
