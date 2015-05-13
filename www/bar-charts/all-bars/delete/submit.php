<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_bar.php';
include_once '../../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli, '../');

include_once "$fnsDir/Users/BarCharts/Bars/delete.php";
Users\BarCharts\Bars\delete($mysqli, $bar);

$message = 'The bar has been deleted.';
$_SESSION['bar-charts/all-bars/messages'] = [$message];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../'.ItemList\itemQuery($bar->id_bar_charts));
