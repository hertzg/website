<?php

function render_next_button ($offset, $limit,
    $total, array &$items, array $params = []) {

    if ($offset + $limit < $total) {
        include_once __DIR__.'/../../fns/Paging/nextButton.php';
        $items[] = Paging\nextButton($offset,
            $limit, 'Notifications', $params);
    }

}
