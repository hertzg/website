<?php

namespace Page;

function newItemButton ($href, $primaryText, $secondaryText) {
    return
        "<a class=\"newItemButton\" href=\"$href\">"
            .'<span class="newItemButton-icon">'
                .'<span class="background horizontal"></span>'
                .'<span class="background vertical"></span>'
                .'<span class="foreground horizontal"></span>'
                .'<span class="foreground vertical"></span>'
            .'</span>'
            .'<span class="newItemButton-text">'
                ."$primaryText <span class=\"secondary\">$secondaryText</span>"
            .'</span>'
        .'</a>';
}
