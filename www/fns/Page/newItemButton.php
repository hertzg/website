<?php

namespace Page;

function newItemButton ($href, $secondaryText, $green = false) {
    $greenClass = $green ? ' green' : ' not_green';
    return
        "<a class=\"newItemButton$greenClass\" href=\"$href\">"
            ."<span class=\"newItemButton-icon$greenClass\">"
                ."<span class=\"newItemButton-icon-line horizontal$greenClass\">"
                .'</span>'
                ."<span class=\"newItemButton-icon-line vertical$greenClass\">"
                .'</span>'
            .'</span>'
            ."<span class=\"newItemButton-text$greenClass\">"
                ."New <span class=\"secondary\">$secondaryText</span>"
            .'</span>'
        .'</a>';
}
