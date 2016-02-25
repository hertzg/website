<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_bar.php';
include_once '../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli);

include_once "$fnsDir/Users/BarCharts/Bars/delete.php";
Users\BarCharts\Bars\delete($mysqli, $bar);

$_SESSION['bar-charts/view/messages'] = ["Bar #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($bar->id_bar_charts));
