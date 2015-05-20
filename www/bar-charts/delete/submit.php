<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

include_once "$fnsDir/Users/BarCharts/delete.php";
Users\BarCharts\delete($mysqli, $bar_chart);

unset($_SESSION['bar-charts/errors']);
$_SESSION['bar-charts/messages'] = ['The bar chart has been deleted.'];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
