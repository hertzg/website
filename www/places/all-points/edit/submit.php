<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../../fns/require_point.php';
include_once '../../../lib/mysqli.php';
list($point, $id, $user) = require_point($mysqli, '../');

include_once '../../fns/request_point_params.php';
list($latitude, $longitude, $altitude,
    $parsed_latitude, $parsed_longitude,
    $parsed_altitude) = request_point_params($errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['places/all-points/edit/errors'] = $errors;
    $_SESSION['places/all-points/edit/values'] = [
        'focus' => $focus,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['places/all-points/edit/errors'],
    $_SESSION['places/all-points/edit/values']
);

include_once "$fnsDir/Users/Places/Points/edit.php";
Users\Places\Points\edit($mysqli, $point,
    $parsed_latitude, $parsed_longitude, $parsed_altitude, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['places/all-points/view/messages'] = [$message];

redirect("../view/$itemQuery");
