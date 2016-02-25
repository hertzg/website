<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_calculations.php';
$user = require_calculations();

include_once "$fnsDir/Users/Calculations/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Calculations\deleteAll($mysqli, $user);

unset($_SESSION['calculations/errors']);
$_SESSION['calculations/messages'] = ['All calculations have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('..');
