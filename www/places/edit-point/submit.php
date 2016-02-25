<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

include_once '../fns/request_point_params.php';
list($latitude, $longitude, $altitude,
    $parsed_latitude, $parsed_longitude,
    $parsed_altitude) = request_point_params($errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['places/edit-point/errors'] = $errors;
    $_SESSION['places/edit-point/values'] = [
        'focus' => $focus,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
    ];
    redirect("./$itemQuery");
}

include_once "$fnsDir/Users/Places/Points/edit.php";
Users\Places\Points\edit($mysqli, $point,
    $parsed_latitude, $parsed_longitude, $parsed_altitude, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['places/view-point/messages'] = [$message];

redirect("../view-point/$itemQuery");
