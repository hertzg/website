<?php

namespace Page;

function title ($title, $content) {
    return
        '<div class="zeroHeight"><br class="zeroHeight" /></div>'
        .'<div class="tab">'
            .'<div class="tab-bar">'
                .'<span class="tab-active">'
                    ."<span class=\"zeroSize\"> &raquo; </span>$title"
                .'</span>'
            .'</div>'
        .'</div>'
        .'<div class="zeroHeight"><br class="zeroHeight" /></div>'
        ."<div class=\"tab-content\">$content</div>";
}
