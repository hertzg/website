<?php

namespace HomePage;

function renderCalendar ($user, &$head, &$scripts, $mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('calendarIcon', '../');

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('calendarIcon', '../');

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once __DIR__.'/checkEventCheckDay.php';
    checkEventCheckDay($mysqli, $user, $time_today);

    include_once __DIR__.'/checkTaskDeadlineCheckDay.php';
    checkTaskDeadlineCheckDay($mysqli, $user, $time_today);

    include_once __DIR__.'/checkBirthdayCheckDay.php';
    checkBirthdayCheckDay($mysqli, $user, $time_today);

    $today = $user->num_events_today +
        $user->num_task_deadlines_today + $user->num_birthdays_today;

    $tomorrow = $user->num_events_tomorrow +
        $user->num_task_deadlines_tomorrow + $user->num_birthdays_tomorrow;

    $n_events = function ($n) {
        if ($n == 1) return '1&nbsp;event';
        return "$n&nbsp;events";
    };

    if ($today || $tomorrow) {

        $descriptions = [];
        if ($today) {
            $descriptions[] =
                '<span class="colorText red">'
                    .$n_events($today).'&nbsp;today.'
                .'</span>';
        }
        if ($tomorrow) $descriptions[] = $n_events($tomorrow).'&nbsp;tomorrow.';

        $description =
            '<span class="zeroHeight"><br class="zeroHeight" /></span>'
            .'<span class="thumbnail_link-description colorText grey">'
                .join(' ', $descriptions)
            .'</span>';

    } else {
        $description = '';
    }

    include_once "$fnsDir/create_calendar_icon_today.php";
    return '<a name="calendar"></a>'
        .'<a href="../calendar/" id="calendar"'
        .' class="clickable link thumbnail_link">'
            .'<span class="thumbnail_link-icon">'
                .create_calendar_icon_today($user)
            .'</span>'
            .'<span class="thumbnail_link-content">'
                .'<span class="thumbnail_link-title">Calendar</span>'
                .$description
            .'</span>'
        .'</a>';

}
