<?php

function render_calendar ($user, $mysqli, array &$items) {

    if (!$user->show_calendar) return;

    $n_events = function ($n) {
        if ($n == 1) return '1 event';
        return "$n events";
    };

    $timeNow = time();
    $dayToday = date('j', $timeNow);
    $monthToday = date('n', $timeNow);
    $yearToday = date('Y', $timeNow);
    $timeToday = mktime(0, 0, 0, $monthToday, $dayToday, $yearToday);
    $timeTomorrow = mktime(0, 0, 0, $monthToday, $dayToday + 1, $yearToday);

    $idusers = $user->idusers;

    include_once __DIR__.'/../../fns/Events/countOnTime.php';
    $numEventsToday = Events\countOnTime($mysqli, $idusers, $timeToday);
    $numEventsTomorrow = Events\countOnTime($mysqli, $idusers, $timeTomorrow);

    $key = 'calendar';
    $title = 'Calendar';
    $href = '../calendar/';
    $icon = 'calendar';
    if ($numEventsToday) {
        if ($numEventsTomorrow) {
            $description =
                $n_events($numEventsToday).' today. '
                .$n_events($numEventsTomorrow).' tomorrow.';
        } else {
            $description = $n_events($numEventsToday).' today.';
        }
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } elseif ($numEventsTomorrow) {
        $description = $n_events($numEventsTomorrow).' tomorrow.';
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
