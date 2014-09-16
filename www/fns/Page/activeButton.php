<?php

namespace Page;

function activeButton ($text, $href, $iconName) {
    return
        "<a class=\"actionButton tag\" href=\"$href\">"
            ."<span class=\"icon $iconName\"></span>"
            .$text
        .'</a>';
}
