<?php

namespace HomePage;

function renderCalendar ($user, $mysqli, &$items, &$scripts) {

    if (!$user->show_calendar) return;

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('calendarIcon', '../');

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
    if ($today || $tomorrow) {

        $descriptions = [];
        if ($today) $descriptions[] = $n_events($today).' today.';
        if ($tomorrow) $descriptions[] = $n_events($tomorrow).' tomorrow.';
        $description = join(' ', $descriptions);

        include_once "$fnsDir/title_and_description.php";
        $content = title_and_description($title, $description);

    } else {
        $content = $title;
    }

    include_once "$fnsDir/user_time_today.php";
    $user_time_today = user_time_today($user);

    $items['calendar'] =
        '<a name="calendar"></a>'
        .'<a href="../calendar/" id="calendar"'
        .' class="clickable link image_link withArrow">'
            .'<div class="image_link-icon">'
                .'<div class="icon calendar">'
                    .'<span id="currentDay">'
                        .date('j', $user_time_today)
                    .'</span>'
                .'</div>'
            .'</div>'
            ."<div class=\"image_link-content\">$content</div>"
        .'</a>';

}
