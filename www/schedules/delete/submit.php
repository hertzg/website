<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);
$id_users = $user->id_users;

include_once '../../fns/Schedules/delete.php';
Schedules\delete($mysqli, $id);

include_once '../../fns/Users/addNumSchedules.php';
Users\addNumSchedules($mysqli, $id_users, -1);

include_once '../../fns/Users/invalidateSchedules.php';
Users\invalidateSchedules($mysqli, $id_users);

$_SESSION['schedules/messages'] = ['Schedule has been deleted.'];
unset($_SESSION['schedules/errors']);

include_once '../../fns/redirect.php';
redirect('..');
