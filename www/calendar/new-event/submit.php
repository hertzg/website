<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($event_day, $event_month, $event_year, $text) = request_strings(
    'event_day', 'event_month', 'event_year', 'text');

$event_day = abs((int)$event_day);
$event_month = abs((int)$event_month);
$event_year = abs((int)$event_year);

include_once '../../fns/str_collapse_spaces.php';
$text = str_collapse_spaces($text);

$errors = [];

include_once '../fns/parse_event_time.php';
parse_event_time($event_day, $event_month, $event_year, $errors, $event_time);

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['calendar/new-event/errors'] = $errors;
    $_SESSION['calendar/new-event/values'] = [
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'text' => $text,
    ];
    redirect();
}

unset(
    $_SESSION['calendar/new-event/errors'],
    $_SESSION['calendar/new-event/values']
);

include_once '../../fns/Users/Events/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Events\add($mysqli, $user, $text, $event_time);

$_SESSION['calendar/view-event/messages'] = ['Event has been saved.'];

redirect("../view-event/?id=$id");
