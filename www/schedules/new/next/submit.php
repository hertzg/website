<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();
$id_users = $user->id_users;

include_once '../../../fns/Schedules/requestSecondStage.php';
list($day_offset) = Schedules\requestSecondStage($first_stage['day_interval']);

$day_interval = $first_stage['day_interval'];

include_once '../../../fns/time_today.php';
$dayToday = time_today() / (60 * 60 * 24);
$day_offset = ($dayToday + $day_offset) % $day_interval;

include_once '../../../fns/Schedules/add.php';
include_once '../../../lib/mysqli.php';
$id = Schedules\add($mysqli, $id_users, $first_stage['text'],
    $day_interval, $day_offset);

include_once '../../../fns/Users/addNumSchedules.php';
Users\addNumSchedules($mysqli, $id_users, 1);

unset(
    $_SESSION['schedules/new/values'],
    $_SESSION['schedules/new/next/first_stage']
);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

include_once '../../../fns/redirect.php';
redirect("../../view/?id=$id");
