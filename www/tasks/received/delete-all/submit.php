<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_received_tasks.php';
$user = require_received_tasks('../');

include_once "$fnsDir/Users/Tasks/Received/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Tasks\Received\deleteAll($mysqli, $user);

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = ['All received tasks have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../..');
