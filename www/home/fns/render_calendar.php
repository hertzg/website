<?php

function render_calendar ($user, $mysqli, &$items) {

    if (!$user->show_calendar) return;

    $fnsPageDir = __DIR__.'/../../fns/Page';

    include_once __DIR__.'/check_event_check_day.php';
    check_event_check_day($mysqli, $user);
    $today = $user->num_events_today;
    $tomorrow = $user->num_events_tomorrow;

    include_once __DIR__.'/check_birthday_check_day.php';
    check_birthday_check_day($mysqli, $user);
    $today += $user->num_birthdays_today;
    $tomorrow += $user->num_birthdays_tomorrow;

    $n_events = function ($n) {
        if ($n == 1) return '1 event';
        return "$n events";
    };

    $title = 'Calendar';
    $href = '../calendar/';
    $icon = 'calendar';
    if ($today) {
        if ($tomorrow) {
            $description =
                $n_events($today).' today. '
                .$n_events($tomorrow).' tomorrow.';
        } else {
            $description = $n_events($today).' today.';
        }
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        $link = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } elseif ($tomorrow) {
        $description = $n_events($tomorrow).' tomorrow.';
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        $link = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        include_once "$fnsPageDir/imageArrowLink.php";
        $link = Page\imageArrowLink($title, $href, $icon);
    }

    $items['calendar'] = $link;

}
