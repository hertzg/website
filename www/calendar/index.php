<?php

function create_calendar ($timeSelected) {

    $monthSelected = date('n', $timeSelected);
    $yearSelected = date('Y', $timeSelected);

    $monthStartTime = mktime(0, 0, 0, $monthSelected, 1, $yearSelected);
    $calendarStartTime = mktime(0, 0, 0, $monthSelected, 1 - date('w', $monthStartTime), $yearSelected);
    $nextMonthStartTime = mktime(0, 0, 0, $monthSelected + 1, 1, $yearSelected);
    $prevMonthStartTime = mktime(0, 0, 0, $monthSelected - 1, 1, $yearSelected);

    $prevMonthHref = '?year='.date('Y', $prevMonthStartTime).'&amp;month='.date('n', $prevMonthStartTime);
    $nextMonthHref = '?year='.date('Y', $nextMonthStartTime).'&amp;month='.date('n', $nextMonthStartTime);

    $html =
        '<div style="background: #eee; font-weight: bold; text-align: center; line-height: 48px; color: #444; position: relative">'
            ."<a href=\"$prevMonthHref\" class=\"clickable navigation-arrow\" style=\"left: 0\">"
                .'<span class="icon arrow-left"></span>'
            .'</a>'
            .'<div style="margin: 0 48px">'
                .date('F d, Y', $timeSelected)
            .'</div>'
            ."<a href=\"$nextMonthHref\" class=\"clickable navigation-arrow\" style=\"right: 0\">"
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
            Page::HR
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

include_once '../lib/page.php';

if (array_key_exists('calendar/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['calendar/index_messages']);
} else {
    $pageMessages = '';
}

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
        $eventItems[] = Page::imageArrowLink(
            htmlspecialchars($event->eventtext),
            "view-event/?idevents=$event->idevents", 'event');
    }
} else {
    $eventItems[] = Page::info('No events on this day.');
}

$title = 'All Events';
$href = 'all-events/';
$icon = 'event';
$num_events = $user->num_events;
if ($num_events) {
    $description = "$num_events total.";
    $eventItems[] = Page::imageArrowLinkWithDescription($title, $description,
        $href, $icon);
} else {
    $eventItems[] = Page::imageArrowLink($title, $href, $icon);
}

$newEventHref = "new-event/?year=$yearSelected&amp;month=$monthSelected&amp;day=$daySelected";
$jumpToHref = "jump-to/?year=$yearNow&amp;month=$monthNow";

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Calendar';
$page->head =
    '<link rel="stylesheet" type="text/css" href="index.css?1" />'
    .'<link rel="stylesheet" type="text/css"'
    ." href=\"themes/$page->theme/index.css\" />";
$page->finish(
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
        join(Page::HR, $eventItems)
    )
    .create_panel(
        'Options',
        Page::imageArrowLink('New Event', $newEventHref, 'create-event')
        .Page::HR
        .Page::imageArrowLink('Jump To', $jumpToHref, 'calendar')
        .Page::HR
        .Page::imageArrowLink('Go to Today', './', 'calendar')
    )
);
