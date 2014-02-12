<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-user.php';

include_once '../../fns/request_strings.php';
list($year, $month, $day, $eventtext) = request_strings(
    'year', 'month', 'day', 'eventtext');

$year = (int)$year;
$month = (int)$month;
$day = (int)$day;
$eventtime = mktime(0, 0, 0, $month, $day, $year);

include_once '../../fns/str_collapse_spaces.php';
$eventtext = str_collapse_spaces($eventtext);

$errors = array();

if ($eventtext === '') $errors[] = 'Enter text.';

if ($errors) {
    $_SESSION['calendar/add-event_errors'] = $errors;
    $_SESSION['calendar/add-event_lastpost'] = array(
        'eventtext' => $eventtext,
    );
    redirect('./?'.http_build_query(array(
        'year' => $year,
        'month' => $month,
        'day' => $day,
    )));
}

unset(
    $_SESSION['calendar/add-event_errors'],
    $_SESSION['calendar/add-event_lastpost']
);

include_once '../../fns/Events/add.php';
include_once '../../lib/mysqli.php';
$id = Events\add($mysqli, $idusers, $eventtext, $eventtime);

$_SESSION['calendar/view-event_messages'] = array('Event has been saved.');

redirect("../view-event/?idevents=$id");
