<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/Schedules/request.php';
list($text, $time_interval, $time_offset) = Schedules\request();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['schedules/edit/errors'] = $errors;
    $_SESSION['schedules/edit/values'] = [
        'text' => $text,
        'time_interval' => $time_interval,
        'time_offset' => $time_offset,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['schedules/edit/errors'],
    $_SESSION['schedules/edit/values']
);

include_once '../../fns/Schedules/edit.php';
Schedules\edit($mysqli, $id, $text, $time_interval * 60 * 60 * 24);

$_SESSION['schedules/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
