<?php

namespace Page;

function emptyTabs ($content) {
    return
        '<div class="tab-spacer"></div>'
        ."<div class=\"tab-content\">$content</div>";
}
