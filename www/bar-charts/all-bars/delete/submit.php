<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_bar.php';
include_once '../../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli, '../');

include_once "$fnsDir/Users/BarCharts/Bars/delete.php";
Users\BarCharts\Bars\delete($mysqli, $bar);

$id_bar_charts = $bar->id_bar_charts;

include_once "$fnsDir/BarCharts/getOnUser.php";
$bar_chart = BarCharts\getOnUser($mysqli, $user->id_users, $id_bar_charts);

include_once "$fnsDir/redirect.php";

$messages = ["Bar #$id has been deleted."];
if ($bar_chart->num_bars) {
    $_SESSION['bar-charts/all-bars/messages'] = $messages;
    include_once "$fnsDir/ItemList/itemQuery.php";
    redirect('../'.ItemList\itemQuery($id_bar_charts));
}

$messages[] = 'No more bars.';
$_SESSION['bar-charts/view/messages'] = $messages;
redirect("../../view/?id=$id_bar_charts");
