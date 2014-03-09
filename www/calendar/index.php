<?php

function create_calendar ($timeSelected) {

    $monthSelected = date('n', $timeSelected);
    $yearSelected = date('Y', $timeSelected);

    $monthStartTime = mktime(0, 0, 0, $monthSelected, 1, $yearSelected);
    $calendarStartTime = mktime(0, 0, 0, $monthSelected,
        1 - date('w', $monthStartTime), $yearSelected);
    $nextMonthStartTime = mktime(0, 0, 0, $monthSelected + 1, 1, $yearSelected);
    $prevMonthStartTime = mktime(0, 0, 0, $monthSelected - 1, 1, $yearSelected);

    $prevMonthYear = date('Y', $prevMonthStartTime);
    $prevMonth = date('n', $prevMonthStartTime);
    $prevMonthHref = "?year=$prevMonthYear&amp;month=$prevMonth";

    $nextMonthYear = date('Y', $nextMonthStartTime);
    $nextMonth = date('n', $nextMonthStartTime);
    $nextMonthHref = "?year=$nextMonthYear&amp;month=$nextMonth";

    $html =
        '<div class="calendarMonths">'
            ."<a href=\"$prevMonthHref\" class=\"clickable navigation-arrow left\">"
                .'<span class="icon arrow-left"></span>'
            .'</a>'
            .'<div style="margin: 0 48px">'
                .date('F d, Y', $timeSelected)
            .'</div>'
            ."<a href=\"$nextMonthHref\" class=\"clickable navigation-arrow right\">"
                .'<span class="icon arrow-right"></span>'
            .'</a>'
        .'</div>'
        .'<div class="calendar-days calendar-weeks">'
            .'<div>Sun</div>'
            .'<div>Mon</div>'
            .'<div>Tue</div>'
            .'<div>Wed</div>'
            .'<div>Thu</div>'
            .'<div>Fri</div>'
            .'<div>Sat</div>'
        .'</div>'
        .'<div style="background: #fff">';

    $time = $calendarStartTime;
    for ($i = 0; $i < 6; $i++) {
        $html .=
            '<div class="hr"></div>'
            .'<div class="calendar-days">';
        for ($j = 0; $j < 7; $j++) {
            $year = date('Y', $time);
            $month = date('n', $time);
            $day = date('j', $time);
            $html .= "<a href=\"?year=$year&amp;month=$month&amp;day=$day\"";
            if ($time == $timeSelected) {
                $html .= ' class="calendar-today">';
            } elseif ($time < $monthStartTime || $time >= $nextMonthStartTime) {
                $html .= ' class="calendar-offmonth">';
            } else {
                $html .= '>';
            }
            $html .= "$day</a>";
            $time += 60 * 60 * 24;
        }
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;

}

include_once __DIR__.'/../fns/require_user.php';
require_user('../');

include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageArrowLinkWithDescription.php';

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('calendar/index_messages');

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['calendar/add-event_errors'],
    $_SESSION['calendar/add-event_lastpost'],
    $_SESSION['calendar/view-event_messages']
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
$events = Events\indexOnUserAndTime($mysqli, $idusers, $timeSelected);

$eventItems = array();
if ($events) {
    foreach ($events as $event) {
        $eventItems[] = Page\imageArrowLink(
            htmlspecialchars($event->eventtext),
            "view-event/?idevents=$event->idevents", 'event');
    }
} else {
    include_once '../fns/Page/info.php';
    $eventItems[] = Page\info('No events on this day.');
}

$title = 'All Events';
$href = 'all-events/';
$icon = 'event';
$num_events = $user->num_events;
if ($num_events) {
    $description = "$num_events total.";
    $eventItems[] = Page\imageArrowLinkWithDescription($title, $description,
        $href, $icon);
} else {
    $eventItems[] = Page\imageArrowLink($title, $href, $icon);
}

$newEventHref = "new-event/?year=$yearSelected&amp;month=$monthSelected&amp;day=$daySelected";
$jumpToHref = "jump-to/?year=$yearNow&amp;month=$monthNow";

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Calendar',
        $pageMessages.create_calendar($timeSelected)
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
        '<link rel="stylesheet" type="text/css" href="index.css?3" />'
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"themes/$user->theme/index.css\" />"
));
