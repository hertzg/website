<?php

function render_prev_button ($offset, $limit,
    $total, array &$items, array $params = []) {

    if ($offset) {
        include_once __DIR__.'/../../fns/Paging/prevButton.php';
        $items[] = Paging\prevButton($offset,
            $limit, $total, 'Notifications', $params);
    }

}
