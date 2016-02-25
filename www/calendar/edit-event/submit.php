<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once '../fns/request_event_params.php';
list($event_day, $event_month, $event_year, $event_time,
    $start_hour, $start_minute, $text) = request_event_params($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calendar/edit-event/errors'] = $errors;
    $_SESSION['calendar/edit-event/values'] = [
        'focus' => $focus,
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'start_hour' => $start_hour,
        'start_minute' => $start_minute,
        'text' => $text,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['calendar/edit-event/errors'],
    $_SESSION['calendar/edit-event/values']
);

include_once "$fnsDir/Users/Events/edit.php";
Users\Events\edit($mysqli, $user, $event, $text,
    $event_time, $start_hour, $start_minute, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['calendar/view-event/messages'] = [$message];

redirect("../view-event/?id=$id");
