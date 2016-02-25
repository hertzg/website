<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_bar_chart.php';
include_once '../../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli, '../');

include_once '../../fns/request_bar_params.php';
list($value, $parsed_value, $label) = request_bar_params($errors);

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";

if ($errors) {
    $_SESSION['bar-charts/all-bars/new/errors'] = $errors;
    $_SESSION['bar-charts/all-bars/new/values'] = [
        'value' => $value,
        'label' => $label,
    ];
    redirect('./'.ItemList\itemQuery($id));
}

unset(
    $_SESSION['bar-charts/all-bars/new/errors'],
    $_SESSION['bar-charts/all-bars/new/values']
);

include_once "$fnsDir/Users/BarCharts/Bars/add.php";
$id = Users\BarCharts\Bars\add($mysqli, $bar_chart, $parsed_value, $label);

$_SESSION['bar-charts/all-bars/view/messages'] = ['Bar has been saved.'];

redirect('../view/'.ItemList\itemQuery($id));
