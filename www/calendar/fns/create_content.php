<?php

function create_content ($mysqli, $user,
    $timeToday, $year, $month, $day, $events_panel) {

    if ($day === null) {
        $day = 1;
        $day_is_selected = false;
    } else {
        $day_is_selected = true;
    }

    $fnsDir = __DIR__.'/../../fns';

    $timeSelected = mktime(0, 0, 0, $month, $day, $year);
    $yearSelected = date('Y', $timeSelected);
    $monthSelected = date('n', $timeSelected);
    $daySelected = date('j', $timeSelected);

    $jumpHref = "jump-to/?year=$yearSelected&amp;month=$monthSelected";
    if ($day_is_selected) $jumpHref .= "&amp;day=$daySelected";

    include_once __DIR__.'/create_calendar.php';
    include_once "$fnsDir/create_calendar_icon_today.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/#calendar',
                ],
            ],
            'Calendar',
            Page\sessionErrors('calendar/errors')
            .Page\sessionMessages('calendar/messages')
            .create_calendar($mysqli, $user->id_users,
                $timeSelected, $timeToday, $day_is_selected),
            Page\newItemButton("new-event/?event_time=$timeSelected",
                'Event', !$user->num_events)
        )
        .$events_panel
        .create_panel(
            'Options',
            Page\staticTwoColumns(
                Page\imageArrowLink('Jump To', $jumpHref,
                    'calendar-jump', ['id' => 'jump-to']),
                '<a href="./" class="clickable link image_link">'
                    .'<span class="image_link-icon">'
                        .create_calendar_icon_today($user)
                    .'</span>'
                    .'<span class="image_link-content">Go to Today</span>'
                .'</a>'
            )
        );

}
