<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents, $user) = require_event($mysqli);

include_once '../../fns/request_strings.php';
list($eventtext) = request_strings('eventtext');

include_once '../../fns/str_collapse_spaces.php';
$eventtext = str_collapse_spaces($eventtext);

$errors = array();

if ($eventtext === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['calendar/edit-event/index_errors'] = $errors;
    $_SESSION['calendar/edit-event/index_lastpost'] = array(
        'eventtext' => $eventtext,
    );
    redirect("./?idevents=$idevents");
}

unset($_SESSION['calendar/edit-event/index_errors']);

include_once '../../fns/Events/edit.php';
Events\edit($mysqli, $user->idusers, $idevents, $eventtext);

$_SESSION['calendar/view-event/index_messages'] = array('Changes have been saved.');

redirect("../view-event/?idevents=$idevents");
