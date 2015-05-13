<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../../fns/require_bar.php';
include_once '../../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli, '../');

include_once '../../fns/request_bar_params.php';
list($value, $parsed_value, $label) = request_bar_params($errors);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['bar-charts/all-bars/edit/errors'] = $errors;
    $_SESSION['bar-charts/all-bars/edit/values'] = [
        'value' => $value,
        'label' => $label,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['bar-charts/all-bars/edit/errors'],
    $_SESSION['bar-charts/all-bars/edit/values']
);

include_once "$fnsDir/Users/BarCharts/Bars/edit.php";
Users\BarCharts\Bars\edit($mysqli, $id, $parsed_value, $label);

$_SESSION['bar-charts/all-bars/view/messages'] = ['Changes have been saved.'];

redirect("../view/$itemQuery");
