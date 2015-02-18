<?php

function create_content ($mysqli, $user,
    $timeSelected, $monthSelected, $daySelected, $eventItems) {

    $fnsDir = __DIR__.'/../../fns';
    $yearParam = 'year='.date('Y', $timeSelected);
    $queryString = "?$yearParam&amp;month=$monthSelected&amp;day=$daySelected";

    include_once __DIR__.'/create_calendar.php';
    include_once "$fnsDir/create_calendar_icon_today.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
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
            .create_calendar($mysqli, $user->id_users, $timeSelected),
            Page\newItemButton("new-event/$queryString", 'Event')
        )
        .create_panel(
            'Events on '.date('F d, Y', $timeSelected),
            join('<div class="hr"></div>', $eventItems)
        )
        .create_panel(
            'Options',
            Page\imageArrowLink('Jump To',
                "jump-to/$queryString", 'calendar', ['id' => 'jump-to'])
            .'<div class="hr"></div>'
            .'<a href="./" class="clickable link image_link">'
                .'<div class="image_link-icon">'
                    .create_calendar_icon_today($user)
                .'</div>'
                .'<div class="image_link-content">Go to Today</div>'
            .'</a>'
        );
}
