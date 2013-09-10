<?php

include_once 'lib/require-event.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';

list($eventtext) = request_strings('eventtext');

$eventtext = str_collapse_spaces($eventtext);

$errors = array();

if ($eventtext == '') {
    $errors[] = 'Enter text.';
}

if ($errors) {
    $_SESSION['calendar/edit-event_errors'] = $errors;
    redirect("edit-event.php?idevents=$idevents");
}

unset($_SESSION['calendar/edit-event_errors']);
Events::edit($idusers, $idevents, $eventtext);
$_SESSION['calendar/view-event_errors'] = array('Changes have been saved.');
redirect("view-event.php?idevents=$idevents");
