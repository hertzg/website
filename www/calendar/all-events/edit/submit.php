<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once '../../fns/request_event_params.php';
list($event_day, $event_month,
    $event_year, $event_time, $text) = request_event_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calendar/all-events/edit/errors'] = $errors;
    $_SESSION['calendar/all-events/edit/values'] = [
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'text' => $text,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['calendar/all-events/edit/errors'],
    $_SESSION['calendar/all-events/edit/values']
);

include_once "$fnsDir/Users/Events/edit.php";
Users\Events\edit($mysqli, $user, $event, $text, $event_time);

$_SESSION['calendar/all-events/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
