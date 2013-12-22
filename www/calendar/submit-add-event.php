<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';

list($year, $month, $day, $eventtext) = request_strings(
    'year', 'month', 'day', 'eventtext');

$year = (int)$year;
$month = (int)$month;
$day = (int)$day;
$eventtext = str_collapse_spaces($eventtext);
$eventtime = mktime(0, 0, 0, $month, $day, $year);

$errors = array();

if ($eventtext === '') {
    $errors[] = 'Enter text.';
}

if ($errors) {
    $_SESSION['calendar/add-event_errors'] = $errors;
    $_SESSION['calendar/add-event_lastpost'] = ['eventtext' => $eventtext];
    redirect('add-event.php?'.http_build_query(array(
        'year' => $year,
        'month' => $month,
        'day' => $day,
    )));
}

unset(
    $_SESSION['calendar/add-event_errors'],
    $_SESSION['calendar/add-event_lastpost']
);

include_once '../classes/Events.php';
$id = Events::add($idusers, $eventtext, $eventtime);

$_SESSION['calendar/view-event_messages'] = array('Event has been saved.');

redirect("view-event.php?idevents=$id");
