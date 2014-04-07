<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
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
    $_SESSION['calendar/add-event/errors'] = $errors;
    $_SESSION['calendar/add-event/values'] = [
        'event_text' => $event_text,
    ];
    redirect('./?'.http_build_query([
        'year' => $year,
        'month' => $month,
        'day' => $day,
    ]));
}

unset(
    $_SESSION['calendar/add-event/errors'],
    $_SESSION['calendar/add-event/values']
);

$event_time = mktime(0, 0, 0, $month, $day, $year);

include_once '../../fns/Events/add.php';
include_once '../../lib/mysqli.php';
$id = Events\add($mysqli, $id_users, $event_text, $event_time);

include_once '../../fns/Users/addNumEvents.php';
Users\addNumEvents($mysqli, $id_users, 1);

include_once '../fns/invalidate_user_events.php';
invalidate_user_events($mysqli, $id_users, $event_time);

$_SESSION['calendar/view-event/messages'] = ['Event has been saved.'];

redirect("../view-event/?id=$id");
