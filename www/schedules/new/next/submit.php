<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();
$id_users = $user->id_users;

include_once '../../../fns/Schedules/requestSecondStage.php';
$days_left = Schedules\requestSecondStage($first_stage['interval']);

$interval = $first_stage['interval'];

include_once '../../../fns/day_today.php';
$offset = (day_today() + $days_left) % $interval;

include_once '../../../fns/Schedules/add.php';
include_once '../../../lib/mysqli.php';
$id = Schedules\add($mysqli, $id_users,
    $first_stage['text'], $interval, $offset);

include_once '../../../fns/Users/Schedules/addNumber.php';
Users\Schedules\addNumber($mysqli, $id_users, 1);

include_once '../../../fns/Users/Schedules/invalidateIfNeeded.php';
Users\Schedules\invalidateIfNeeded($mysqli, $user, $days_left);

unset(
    $_SESSION['schedules/new/values'],
    $_SESSION['schedules/new/next/first_stage']
);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

include_once '../../../fns/redirect.php';
redirect("../../view/?id=$id");
