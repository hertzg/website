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

$time_interval = $day_interval * 60 * 60 * 24;

include_once '../../fns/Schedules/edit.php';
Schedules\edit($mysqli, $id, $text, $time_interval);

$_SESSION['schedules/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
