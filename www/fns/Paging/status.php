<?php

namespace Paging;

function status ($offset, $limit, $total, $label) {
    return
        '<div style="background: #eee; text-align: right; font-size: 12px; line-height: 14px; color: #555; padding: 2px">'
            ."Showing $label from $offset to "
            .min($offset + $limit - 1, $total)." out of total $total."
        .'</div>'
        .'<div class="hr"></div>';
}
