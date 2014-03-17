<?php

include_once __DIR__.'/../fns/require_user.php';
$user = require_user('../');

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['calendar/add-event/index_errors'],
    $_SESSION['calendar/add-event/index_lastpost'],
    $_SESSION['calendar/view-event/index_messages']
);

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
if ($events) {
    include_once '../fns/Page/imageArrowLink.php';
    foreach ($events as $event) {
        $title = htmlspecialchars($event->eventtext);
        $href = "view-event/?idevents=$event->idevents";
        $eventItems[] = Page\imageArrowLink($title, $href, 'event');
    }
} else {
    include_once '../fns/Page/info.php';
    $eventItems[] = Page\info('No events on this day.');
}

include_once 'fns/create_all_events_link.php';
$eventItems[] = create_all_events_link($user);

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
                'href' => '..',
            ),
        ),
        'Calendar',
        Page\sessionErrors('calendar/index_errors')
        .Page\sessionMessages('calendar/index_messages')
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
