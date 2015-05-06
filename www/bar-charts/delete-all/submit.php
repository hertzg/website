<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/Users/BarCharts/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\BarCharts\deleteAll($mysqli, $user);

unset($_SESSION['bar-charts/errors']);
$_SESSION['bar-charts/messages'] = ['All bar charts have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('..');
