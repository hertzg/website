<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Schedules/request.php';
list($text, $day_interval, $day_offset) = Schedules\request();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['schedules/new/errors'] = $errors;
    $_SESSION['schedules/new/values'] = [
        'text' => $text,
        'day_interval' => $day_interval,
        'day_offset' => $day_offset,
    ];
    redirect();
}

unset(
    $_SESSION['schedules/new/errors'],
    $_SESSION['schedules/new/values']
);

include_once '../../fns/time_today.php';
$dayToday = time_today() / (60 * 60 * 24);
$day_offset = ($dayToday + $day_offset) % $day_interval;

include_once '../../fns/Schedules/add.php';
include_once '../../lib/mysqli.php';
$id = Schedules\add($mysqli, $user->id_users, $text,
    $day_interval, $day_offset);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

redirect("../view/?id=$id");
