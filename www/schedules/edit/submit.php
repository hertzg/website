<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/Schedules/requestFirstStage.php';
list($text, $day_interval) = Schedules\requestFirstStage();

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

$_SESSION['schedules/edit/values'] = [
    'text' => $text,
    'day_interval' => $day_interval,
];

if ($errors) {
    $_SESSION['schedules/edit/errors'] = $errors;
    redirect("./?id=$id");
}

unset($_SESSION['schedules/edit/errors']);

$_SESSION['schedules/edit/next/first_stage'] = [
    'schedule' => $schedule,
    'text' => $text,
    'day_interval' => $day_interval,
];

redirect('next/');
