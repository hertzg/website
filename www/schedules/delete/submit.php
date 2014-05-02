<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/Schedules/delete.php';
Schedules\delete($mysqli, $id);

include_once '../../fns/Users/Schedules/addNumber.php';
Users\Schedules\addNumber($mysqli, $user->id_users, -1);

include_once '../fns/days_left_from_today.php';
$days_left = days_left_from_today($schedule->interval, $schedule->offset);

include_once '../../fns/Users/Schedules/invalidateIfNeeded.php';
Users\Schedules\invalidateIfNeeded($mysqli, $user, $days_left);

$_SESSION['schedules/messages'] = ['Schedule has been deleted.'];
unset($_SESSION['schedules/errors']);

include_once '../../fns/redirect.php';
redirect('..');
