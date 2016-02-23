<?php

namespace ViewPage;

function calendarLink ($event, $base, &$head) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('calendarIcon', "$base../../");

    $event_time = $event->event_time;
    $year = date('Y', $event_time);
    $month = date('n', $event_time);
    $day = date('j', $event_time);

    include_once "$fnsDir/format_event_time.php";
    include_once "$fnsDir/Page/calendarLink.php";
    return \Page\calendarLink(format_event_time($event),
        "$base../?year=$year&amp;month=$month&amp;day=$day", $day);

}
