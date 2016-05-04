<?php

namespace Page;

function emptyTabs ($content) {
    return
        '<div class="zeroHeight"><br class="zeroHeight" /></div>'
        ."<div class=\"tab-content\">$content</div>";
}
