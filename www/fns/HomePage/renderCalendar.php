<?php

namespace HomePage;

function renderCalendar ($user, $mysqli, &$items) {

    if (!$user->show_calendar) return;

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/checkEventCheckDay.php';
    checkEventCheckDay($mysqli, $user);
    $today = $user->num_events_today;
    $tomorrow = $user->num_events_tomorrow;

    include_once __DIR__.'/checkTaskDeadlineCheckDay.php';
    checkTaskDeadlineCheckDay($mysqli, $user);
    $today += $user->num_task_deadlines_today;
    $tomorrow += $user->num_task_deadlines_tomorrow;

    include_once __DIR__.'/checkBirthdayCheckDay.php';
    checkBirthdayCheckDay($mysqli, $user);
    $today += $user->num_birthdays_today;
    $tomorrow += $user->num_birthdays_tomorrow;

    $n_events = function ($n) {
        if ($n == 1) return '1 event';
        return "$n events";
    };

    $title = 'Calendar';
    $href = '../calendar/';
    $icon = 'calendar';
    if ($today || $tomorrow) {

        $descriptionItems = [];
        if ($today) $descriptionItems[] = $n_events($today).' today.';
        if ($tomorrow) $descriptionItems[] = $n_events($tomorrow).' tomorrow.';
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon);
    }

    $items['calendar'] = $link;

}
