<?php

namespace Page\Tabs;

function normalTab ($text, $href) {
    return
        '<div class="page_tabs-tab normal">'
            ."<a class=\"page_tabs-tab-link clickable\" href=\"$href\">"
                .$text
            .'</a>'
        ."</div>";
}
