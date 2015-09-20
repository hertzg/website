<?php

namespace Page;

function newItemButton ($href, $secondaryText) {
    return
        "<a class=\"newItemButton\" href=\"$href\">"
            .'<span class="newItemButton-icon">'
                .'<span class="newItemButton-icon-line horizontal"></span>'
                .'<span class="newItemButton-icon-line vertical"></span>'
            .'</span>'
            .'<span class="newItemButton-text">'
                ."New <span class=\"secondary\">$secondaryText</span>"
            .'</span>'
        .'</a>';
}
