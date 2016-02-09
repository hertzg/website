<?php

namespace Page;

function emptyTabs ($content) {
    return
        '<br class="zeroHeight" />'
        ."<div class=\"tab-content\">$content</div>";
}
