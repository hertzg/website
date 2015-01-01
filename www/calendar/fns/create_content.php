<?php

function create_content ($mysqli, $id_users,
    $timeSelected, $monthSelected, $daySelected, $eventItems) {

    $fnsDir = __DIR__.'/../../fns';
    $yearSelected = date('Y', $timeSelected);
    $yearParam = "year=$yearSelected";
    $queryString = "?$yearParam&amp;month=$monthSelected&amp;day=$daySelected";

    include_once __DIR__.'/create_calendar.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
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
            .create_calendar($mysqli, $id_users, $timeSelected)
        )
        .create_panel(
            'Events on '.date('F d, Y', $timeSelected),
            join('<div class="hr"></div>', $eventItems)
        )
        .create_panel(
            'Options',
            Page\imageArrowLink('New Event',
                "new-event/$queryString", 'create-event', ['id' => 'new-event'])
            .'<div class="hr"></div>'
            .Page\imageArrowLink('Jump To',
                "jump-to/$queryString", 'calendar', ['id' => 'jump-to'])
            .'<div class="hr"></div>'
            .Page\imageArrowLink('Go to Today', './', 'calendar')
        );
}
