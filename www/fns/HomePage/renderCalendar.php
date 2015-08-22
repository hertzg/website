<?php

namespace HomePage;

function renderCalendar ($user, $mysqli, &$items, &$scripts) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_event) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-event'] = \Page\imageArrowLink(
            'New Event', '../calendar/new-event/', 'create-event');
    }

    if (!$user->show_calendar) return;

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('calendarIcon', '../');

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once __DIR__.'/checkEventCheckDay.php';
    checkEventCheckDay($mysqli, $user, $time_today);
    $today = $user->num_events_today;
    $tomorrow = $user->num_events_tomorrow;

    include_once __DIR__.'/checkTaskDeadlineCheckDay.php';
    checkTaskDeadlineCheckDay($mysqli, $user, $time_today);
    $today += $user->num_task_deadlines_today;
    $tomorrow += $user->num_task_deadlines_tomorrow;

    include_once __DIR__.'/checkBirthdayCheckDay.php';
    checkBirthdayCheckDay($mysqli, $user, $time_today);
    $today += $user->num_birthdays_today;
    $tomorrow += $user->num_birthdays_tomorrow;

    $n_events = function ($n) {
        if ($n == 1) return '1 event';
        return "$n events";
    };

    $title = 'Calendar';
    if ($today || $tomorrow) {

        $descriptions = [];
        if ($today) {
            $descriptions[] =
                '<span class="redText">'
                    .$n_events($today).' today.'
                .'</span>';
        }
        if ($tomorrow) $descriptions[] = $n_events($tomorrow).' tomorrow.';
        $description = join(' ', $descriptions);

        include_once "$fnsDir/title_and_description.php";
        $content = title_and_description($title, $description);

    } else {
        $content = $title;
    }

    include_once "$fnsDir/create_calendar_icon_today.php";
    $items['calendar'] =
        '<a name="calendar"></a>'
        .'<a href="../calendar/" id="calendar"'
        .' class="clickable link image_link withArrow">'
            .'<span class="image_link-icon">'
                .create_calendar_icon_today($user)
            .'</span>'
            ."<span class=\"image_link-content\">$content</span>"
        .'</a>';

}
