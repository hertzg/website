<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

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
    $_SESSION['calendar/new-event/errors'] = $errors;
    $_SESSION['calendar/new-event/values'] = [
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'event_text' => $event_text,
    ];
    redirect();
}

unset(
    $_SESSION['calendar/new-event/errors'],
    $_SESSION['calendar/new-event/values']
);

include_once '../../fns/Users/Events/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Events\add($mysqli, $user, $event_text, $event_time);

$_SESSION['calendar/view-event/messages'] = ['Event has been saved.'];

redirect("../view-event/?id=$id");
