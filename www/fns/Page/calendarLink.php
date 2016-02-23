<?php

namespace Page;

function calendarLink ($content, $href, $day, $options = []) {
    include_once __DIR__.'/../create_calendar_icon.php';
    return
        "<a href=\"$href\" class=\"clickable link image_link\">"
            .'<span class="image_link-icon">'
                .create_calendar_icon($day)
            .'</span>'
            ."<span class=\"image_link-content\">$content</span>"
        .'</a>';
}
