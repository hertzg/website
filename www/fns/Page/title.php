<?php

namespace Page;

function title ($title, $content) {
    return
        '<br class="zeroHeight" />'
        .'<div class="tab">'
            .'<div class="tab-bar">'
                .'<span class="tab-active">'
                    ."<span class=\"zeroSize\"> &raquo; </span>$title"
                .'</span>'
            .'</div>'
        .'</div>'
        .'<br class="zeroHeight" />'
        ."<div class=\"tab-content\">$content</div>";
}
