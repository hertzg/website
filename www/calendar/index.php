<?php

include_once __DIR__.'/../fns/require_user.php';
$user = require_user('../');

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/request_strings.php';
list($year, $month, $day) = request_strings('year', 'month', 'day');

$timeNow = time();
$monthNow = (int)date('n', $timeNow);
$yearNow = (int)date('Y', $timeNow);

if ($year === '') $year = $yearNow;
else $year = (int)$year;

if ($month === '') $month = $monthNow;
else $month = (int)$month;

if ($day === '') $day = date('d', $timeNow);
else $day = (int)$day;

$timeSelected = mktime(0, 0, 0, $month, $day, $year);
$yearSelected = date('Y', $timeSelected);
$monthSelected = date('n', $timeSelected);
$daySelected = date('d', $timeSelected);

include_once '../fns/Events/indexOnUserAndTime.php';
include_once '../lib/mysqli.php';
$events = Events\indexOnUserAndTime($mysqli, $user->idusers, $timeSelected);

$eventItems = array();
include_once 'fns/render_events.php';
render_events($events, $eventItems);

if ($user->num_events) {
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    $eventItems[] = Page\imageArrowLinkWithDescription('All Events',
        "$user->num_events total.", 'all-events/', 'event');
}

$newEventHref =
    "new-event/?year=$yearSelected&amp;month=$monthSelected&amp;day=$daySelected";
$jumpToHref = "jump-to/?year=$yearNow&amp;month=$monthNow";

include_once 'fns/create_calendar.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../home/',
            ),
        ),
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

include_once '../fns/echo_page.php';
echo_page($user, 'Calendar', $content, '../', array(
    'head' =>
        '<link rel="stylesheet" type="text/css" href="index.css?5" />'
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"themes/$user->theme/index.css?2\" />"
));
