<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Schedules/request.php';
list($text, $day_interval, $time_offset) = Schedules\request();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['schedules/new/errors'] = $errors;
    $_SESSION['schedules/new/values'] = [
        'text' => $text,
        'day_interval' => $day_interval,
        'time_offset' => $time_offset,
    ];
    redirect();
}

unset(
    $_SESSION['schedules/new/errors'],
    $_SESSION['schedules/new/values']
);

$time_interval = $day_interval * 60 * 60 * 24;

include_once '../../fns/Schedules/add.php';
include_once '../../lib/mysqli.php';
$id = Schedules\add($mysqli, $user->id_users, $text, $day_interval);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

redirect("../view/?id=$id");
