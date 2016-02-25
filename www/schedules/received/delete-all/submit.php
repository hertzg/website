<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_received_schedules.php';
$user = require_received_schedules('../');

include_once "$fnsDir/Users/Schedules/Received/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Schedules\Received\deleteAll($mysqli, $user);

unset($_SESSION['schedules/errors']);
$_SESSION['schedules/messages'] = ['All received schedules have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../..');
