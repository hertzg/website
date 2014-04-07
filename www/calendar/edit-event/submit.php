<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($day, $month, $year, $event_text) = request_strings(
    'day', 'month', 'year', 'event_text');

$day = (int)$day;
$month = (int)$month;
$year = (int)$year;

include_once '../../fns/str_collapse_spaces.php';
$event_text = str_collapse_spaces($event_text);

$errors = [];

include_once '../fns/check_date.php';
check_date($day, $month, $year, $errors);

if ($event_text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['calendar/edit-event/errors'] = $errors;
    $_SESSION['calendar/edit-event/values'] = [
        'day' => $day,
        'month' => $month,
        'year' => $year,
        'event_text' => $event_text,
    ];
    redirect("./?id=$id");
}

unset($_SESSION['calendar/edit-event/errors']);

$event_time = mktime(0, 0, 0, $month, $day, $year);

include_once '../../fns/Events/edit.php';
Events\edit($mysqli, $id_users, $id, $event_time, $event_text);

include_once '../fns/invalidate_user_events.php';
invalidate_user_events($mysqli, $id_users, $event->event_time);
invalidate_user_events($mysqli, $id_users, $event_time);

$_SESSION['calendar/view-event/messages'] = ['Changes have been saved.'];

redirect("../view-event/?id=$id");
