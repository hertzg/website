<?php

include_once __DIR__.'/../fns/require_user.php';
$user = require_user('../');
$id_users = $user->id_users;

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/request_strings.php';
list($year, $month, $day) = request_strings('year', 'month', 'day');

include_once '../fns/time_today.php';
$timeToday = time_today();

$monthToday = (int)date('n', $timeToday);
$yearToday = (int)date('Y', $timeToday);
$dayToday = (int)date('d', $timeToday);

if ($year === '') $year = $yearToday;
else $year = (int)$year;

if ($month === '') $month = $monthToday;
else $month = (int)$month;

if ($day === '') $day = $dayToday;
else $day = (int)$day;

$timeSelected = mktime(0, 0, 0, $month, $day, $year);
$yearSelected = date('Y', $timeSelected);
$monthSelected = date('n', $timeSelected);
$daySelected = date('j', $timeSelected);

include_once '../fns/Events/indexOnUserAndTime.php';
include_once '../lib/mysqli.php';
$events = Events\indexOnUserAndTime($mysqli, $id_users, $timeSelected);

include_once '../fns/Contacts/indexBirthdays.php';
$contacts = Contacts\indexBirthdays($mysqli,
    $id_users, $daySelected, $monthSelected);

include_once 'fns/render_events.php';
render_events($contacts, $events, $eventItems);

if ($user->num_events) {
    $title = 'All Events';
    $description = "$user->num_events total.";
    $href = 'all-events/';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    $eventItems[] = Page\imageArrowLinkWithDescription($title,
        $description, $href, 'events');
}

$yearParam = "year=$yearSelected";
$queryString = "?$yearParam&amp;month=$monthSelected&amp;day=$daySelected";
$newEventHref = "new-event/$queryString";
$jumpToHref = "jump-to/$queryString";

include_once 'fns/create_calendar.php';
include_once '../fns/create_panel.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
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

include_once '../fns/echo_page.php';
echo_page($user, 'Calendar', $content, '../', [
    'head' =>
        '<link rel="stylesheet" type="text/css" href="index.css?7" />'
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"themes/$user->theme/index.css?2\" />"
]);
