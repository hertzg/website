<?php

namespace Paging;

function status ($offset, $limit, $total, $label) {
    return
        '<div class="Paging-status">'
            ."Showing $label from $offset to "
            .min($offset + $limit - 1, $total)." out of total $total."
        .'</div>'
        .'<div class="hr"></div>';
}
