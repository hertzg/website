<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_first_stage.php';
list($user, $id, $schedule, $first_stage) = require_first_stage();

include_once '../../../fns/Schedules/requestSecondStage.php';
list($offset) = Schedules\requestSecondStage($first_stage['interval']);

$interval = $first_stage['interval'];

include_once '../../../fns/day_today.php';
$day_today = day_today();

$offset = ($day_today + $offset) % $interval;

include_once '../../../fns/Schedules/edit.php';
include_once '../../../lib/mysqli.php';
Schedules\edit($mysqli, $id, $first_stage['text'], $interval, $offset);

include_once '../../../fns/days_left.php';
$oldOffset = days_left($schedule->interval, $schedule->offset, $day_today);

include_once '../../../fns/Users/Schedules/invalidateIfNeeded.php';
Users\Schedules\invalidateIfNeeded($mysqli, $user, $offset);
Users\Schedules\invalidateIfNeeded($mysqli, $user, $oldOffset);

unset(
    $_SESSION['schedules/edit/values'],
    $_SESSION['schedules/edit/next/first_stage']
);

$_SESSION['schedules/view/messages'] = ['Changes have been saved.'];

include_once '../../../fns/redirect.php';
redirect("../../view/?id=$id");
