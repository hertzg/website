<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_schedules.php';
$user = require_schedules();

include_once "$fnsDir/Users/Schedules/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Schedules\deleteAll($mysqli, $user);

unset($_SESSION['schedules/errors']);
$_SESSION['schedules/messages'] = ['All schedules have been delete.'];

include_once "$fnsDir/redirect.php";
redirect('..');
