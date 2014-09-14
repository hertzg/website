<?php

namespace Paging;

function status ($offset, $limit, $total, $label) {
    $endIndex = min($offset + $limit - 1, $total);
    return
        '<div class="Paging-status">'
            ."Showing $label from $offset to $endIndex out of total $total."
        .'</div>'
        .'<div class="hr"></div>';
}
