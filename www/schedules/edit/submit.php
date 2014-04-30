<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/Schedules/request.php';
list($text, $day_interval, $day_offset) = Schedules\request();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['schedules/edit/errors'] = $errors;
    $_SESSION['schedules/edit/values'] = [
        'text' => $text,
        'day_interval' => $day_interval,
        'day_offset' => $day_offset,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['schedules/edit/errors'],
    $_SESSION['schedules/edit/values']
);

include_once '../../fns/time_today.php';
$start_day = time_today() / (60 * 60 * 24) + $day_offset;
$day_offset = $start_day % $day_interval;

include_once '../../fns/Schedules/edit.php';
Schedules\edit($mysqli, $id, $text, $day_interval, $day_offset, $start_day);

$_SESSION['schedules/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
