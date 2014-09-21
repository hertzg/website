<?php

function render_next_button ($offset, $limit,
    $total, &$items, $params = [], $base = '') {

    if ($offset + $limit < $total) {
        include_once __DIR__.'/../../fns/Paging/nextButton.php';
        $items[] = Paging\nextButton($offset,
            $limit, 'Notifications', $params, $base);
    }

}
