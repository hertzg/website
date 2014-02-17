<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents) = require_event($mysqli);

include_once '../../fns/request_strings.php';
list($eventtext) = request_strings('eventtext');

include_once '../../fns/str_collapse_spaces.php';
$eventtext = str_collapse_spaces($eventtext);

$errors = array();

if ($eventtext === '') $errors[] = 'Enter text.';

if ($errors) {
    $_SESSION['calendar/edit-event_errors'] = $errors;
    redirect("./?idevents=$idevents");
}

unset($_SESSION['calendar/edit-event_errors']);

include_once '../../fns/Events/edit.php';
Events\edit($mysqli, $idusers, $idevents, $eventtext);

$_SESSION['calendar/view-event_messages'] = array('Changes have been saved.');

redirect("../view-event/?idevents=$idevents");
