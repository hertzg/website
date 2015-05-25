<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

include_once '../fns/request_bar_chart_params.php';
list($name, $tags, $tag_names) = request_bar_chart_params($errors);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['bar-charts/edit/errors'] = $errors;
    $_SESSION['bar-charts/edit/values'] = ['name' => $name];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['bar-charts/edit/errors'],
    $_SESSION['bar-charts/edit/values']
);

include_once "$fnsDir/Users/BarCharts/edit.php";
Users\BarCharts\edit($mysqli, $id, $name);

$_SESSION['bar-charts/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
