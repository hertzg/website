<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../../fns/Schedules/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Schedules\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/clearNumSchedules.php';
Users\clearNumSchedules($mysqli, $id_users);

include_once '../../fns/Users/invalidateSchedules.php';
Users\invalidateSchedules($mysqli, $id_users);

$_SESSION['schedules/messages'] = ['All schedules have been delete.'];
unset($_SESSION['schedules/errors']);

include_once '../../fns/redirect.php';
redirect('..');
