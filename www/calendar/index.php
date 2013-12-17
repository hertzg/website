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
                .Page::icon('arrow-left')
            .'</a>'
            .'<div style="margin: 0 48px">'
                .date('F d, Y', $timeSelected)
            .'</div>'
            ."<a href=\"$nextMonthHref\" class=\"clickable navigation-arrow\" style=\"right: 0\">"
                .Page::icon('arrow-right')
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

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Events.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset(
    $_SESSION['home_messages'],
    $_SESSION['calendar/add-event_errors'],
    $_SESSION['calendar/add-event_lastpost']
);

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

$eventItems = array();
$events = Events::index($idusers, $timeSelected);
if ($events) {
    foreach ($events as $event) {
        $eventItems[] = Page::imageLink(htmlspecialchars($event->eventtext), "view-event.php?idevents=$event->idevents", 'event');
    }
} else {
    $eventItems[] = Page::info('No events.');
}

$page->base = '../';
$page->title = 'Calendar';
$page->head =
    '<link rel="stylesheet" type="text/css" href="index.css?1" />'
    ."<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/$page->theme/index.css\" />";
$page->finish(
    Tab::create(
        Tab::activeItem('Calendar'),
        Page::messages(ifset($_SESSION['calendar/index_messages']))
        .create_calendar($timeSelected)
    )
    .create_panel(
        'Events',
        join(Page::HR, $eventItems)
    )
    .create_panel(
        'Options',
        Page::imageLink('New Event', "add-event.php?year=$yearSelected&month=$monthSelected&day=$daySelected", 'create-event')
        .Page::HR
        .Page::imageLink('Jump To', "jump-to.php?year=$yearNow&month=$monthNow", 'calendar')
        .Page::HR
        .Page::imageLink('Go to Today', './', 'calendar')
    )
);
