<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once '../../fns/request_strings.php';
list($event_day, $event_month, $event_year, $event_text) = request_strings(
    'event_day', 'event_month', 'event_year', 'event_text');

$event_day = abs((int)$event_day);
$event_month = abs((int)$event_month);
$event_year = abs((int)$event_year);

include_once '../../fns/str_collapse_spaces.php';
$event_text = str_collapse_spaces($event_text);

$errors = [];

include_once '../fns/parse_event_time.php';
parse_event_time($event_day, $event_month, $event_year, $errors, $event_time);

if ($event_text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['calendar/edit-event/errors'] = $errors;
    $_SESSION['calendar/edit-event/values'] = [
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'event_text' => $event_text,
    ];
    redirect("./?id=$id");
}

unset($_SESSION['calendar/edit-event/errors']);

include_once '../../fns/Events/edit.php';
Events\edit($mysqli, $user->id_users, $id, $event_time, $event_text);

include_once '../fns/invalidate_user_events.php';
invalidate_user_events($mysqli, $user, $event->event_time);
invalidate_user_events($mysqli, $user, $event_time);

$_SESSION['calendar/view-event/messages'] = ['Changes have been saved.'];

redirect("../view-event/?id=$id");
