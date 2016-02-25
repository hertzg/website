<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

include_once '../fns/request_bar_params.php';
list($value, $parsed_value, $label) = request_bar_params($errors);

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";

if ($errors) {
    $_SESSION['bar-charts/new-bar/errors'] = $errors;
    $_SESSION['bar-charts/new-bar/values'] = [
        'value' => $value,
        'label' => $label,
    ];
    redirect('./'.ItemList\itemQuery($id));
}

unset(
    $_SESSION['bar-charts/new-bar/errors'],
    $_SESSION['bar-charts/new-bar/values']
);

$_SESSION['bar-charts/view-bar/messages'] = ['Bar has been saved.'];

include_once "$fnsDir/Users/BarCharts/Bars/add.php";
$id = Users\BarCharts\Bars\add($mysqli, $bar_chart, $parsed_value, $label);

redirect('../view-bar/'.ItemList\itemQuery($id));
