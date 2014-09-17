<?php

namespace Page;

function newItemButton ($href, $secondaryText) {
    return
        "<a class=\"newItemButton\" href=\"$href\">"
            .'<span class="newItemButton-icon">'
                .'<span class="background horizontal"></span>'
                .'<span class="background vertical"></span>'
                .'<span class="foreground horizontal"></span>'
                .'<span class="foreground vertical"></span>'
            .'</span>'
            .'<span class="newItemButton-text">'
                ."New <span class=\"secondary\">$secondaryText</span>"
            .'</span>'
        .'</a>';
}
