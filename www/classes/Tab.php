<?php

class Tab {

    static function activeItem ($title) {
        return "<span class=\"tab-active\">$title</span>";
    }

    static function create ($items) {
        return
            "<div class=\"tab\">"
                ."<div class=\"tab-bar\">$items</div>"
            ."</div>"
            .'<div class="tab-spacer"></div>';
    }

    static function item ($title, $href) {
        return
            "<a class=\"tab-normal\" href=\"$href\">"
                .$title
            .'</a>';
    }

}
