<?php

function render_calendar ($user, $mysqli, array &$items) {

    include_once __DIR__.'/check_event_check_day.php';
    check_event_check_day($mysqli, $user);
    $num_events_today = $user->num_events_today;
    $num_events_tomorrow = $user->num_events_tomorrow;

    if (!$user->show_calendar) return;

    $n_events = function ($n) {
        if ($n == 1) return '1 event';
        return "$n events";
    };

    $key = 'calendar';
    $title = 'Calendar';
    $href = '../calendar/';
    $icon = 'calendar';
    if ($num_events_today) {
        if ($num_events_tomorrow) {
            $description =
                $n_events($num_events_today).' today. '
                .$n_events($num_events_tomorrow).' tomorrow.';
        } else {
            $description = $n_events($num_events_today).' today.';
        }
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } elseif ($num_events_tomorrow) {
        $description = $n_events($num_events_tomorrow).' tomorrow.';
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
