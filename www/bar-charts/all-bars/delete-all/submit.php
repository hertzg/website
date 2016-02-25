<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_bars.php';
include_once '../../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bars($mysqli, '../');

include_once "$fnsDir/Users/BarCharts/Bars/deleteAll.php";
Users\BarCharts\Bars\deleteAll($mysqli, $bar_chart);

$_SESSION['bar-charts/view/messages'] = ['All bars have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect("../../view/?id=$id");
