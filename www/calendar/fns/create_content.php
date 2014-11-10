<?php

function create_content ($timeSelected,
    $monthSelected, $daySelected, $eventItems) {

    $fnsDir = __DIR__.'/../../fns';
    $yearSelected = date('Y', $timeSelected);
    $yearParam = "year=$yearSelected";
    $queryString = "?$yearParam&amp;month=$monthSelected&amp;day=$daySelected";
    $newEventHref = "new-event/$queryString";
    $jumpToHref = "jump-to/$queryString";

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
                    'href' => '../home/',
                ],
            ],
            'Calendar',
            Page\sessionErrors('calendar/errors')
            .Page\sessionMessages('calendar/messages')
            .create_calendar($timeSelected)
        )
        .create_panel(
            'Events on '.date('F d, Y', $timeSelected),
            join('<div class="hr"></div>', $eventItems)
        )
        .create_panel(
            'Options',
            Page\imageArrowLink('New Event', $newEventHref, 'create-event')
            .'<div class="hr"></div>'
            .Page\imageArrowLink('Jump To', $jumpToHref, 'calendar')
            .'<div class="hr"></div>'
            .Page\imageArrowLink('Go to Today', './', 'calendar')
        );
}
