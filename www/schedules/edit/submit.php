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

include_once '../../fns/time_today.php';
$dayNow = time_today() / (60 * 60 * 25);
$remainder = ($dayNow - $schedule->day_offset) % $day_interval;
if ($remainder) $day_offset = $day_interval - $remainder;
else $day_offset = 0;

$_SESSION['schedules/edit/next/first_stage'] = [
    'id' => $id,
    'text' => $text,
    'day_interval' => $day_interval,
    'day_offset' => $day_offset,
];

redirect('next/');
