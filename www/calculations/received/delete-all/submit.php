<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_received_calculations.php';
$user = require_received_calculations('../');

include_once "$fnsDir/Users/Calculations/Received/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Calculations\Received\deleteAll($mysqli, $user);

unset($_SESSION['calculations/errors']);
$_SESSION['calculations/messages'] = [
    'All received calculations have been deleted.',
];

include_once "$fnsDir/redirect.php";
redirect('../..');
