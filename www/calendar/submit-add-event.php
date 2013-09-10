<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Events.php';

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
    $_SESSION['calendar/add-event_lastpost'] = $_POST;
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

$_SESSION['calendar/index_messages'] = array('Event has been added.');

Events::add($idusers, $eventtext, $eventtime);
redirect('index.php?'.http_build_query(array(
    'year' => $year,
    'month' => $month,
    'day' => $day,
)));
