<?php

namespace Page;

function calendarTodayLink ($user, $href) {
    include_once __DIR__.'/../create_calendar_icon_today.php';
    return
        '<a name="calendar"></a>'
        ."<a href=\"$href\" id=\"calendar\""
        ." class=\"clickable link image_link withArrow localNavigation-link\">"
            .'<span class="image_link-icon">'
                .create_calendar_icon_today($user)
            .'</span>'
            .'<span class="image_link-content">Calendar</span>'
        .'</a>';
}
