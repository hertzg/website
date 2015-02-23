<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$errors = [];

include_once '../fns/request_point_params.php';
list($latitude, $longitude, $altitude, $parsed_latitude,
    $parsed_longitude, $parsed_altitude) = request_point_params($errors);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['places/edit-point/errors'] = $errors;
    $_SESSION['places/edit-point/values'] = [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
    ];
    redirect("./$itemQuery");
}

include_once "$fnsDir/Users/Places/Points/edit.php";
Users\Places\Points\edit($mysqli, $point,
    $parsed_latitude, $parsed_longitude, $parsed_altitude);

$_SESSION['places/view-point/messages'] = ['Changes have been saved.'];

redirect("../view-point/$itemQuery");
