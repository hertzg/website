<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/Schedules/delete.php';
Schedules\delete($mysqli, $id);

include_once '../../fns/Users/addNumSchedules.php';
Users\addNumSchedules($mysqli, $user->id_users, -1);

$interval = $schedule->interval;
include_once '../../fns/day_today.php';
$remainder = (day_today() - $schedule->offset) % $interval;
if ($remainder) $offset = $interval - $remainder;
else $offset = 0;

include_once '../../fns/Users/Schedules/invalidateIfNeeded.php';
Users\Schedules\invalidateIfNeeded($mysqli, $user, $offset);

$_SESSION['schedules/messages'] = ['Schedule has been deleted.'];
unset($_SESSION['schedules/errors']);

include_once '../../fns/redirect.php';
redirect('..');
