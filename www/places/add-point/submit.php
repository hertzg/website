<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$errors = [];

include_once 'fns/request_point_params.php';
list($latitude, $longitude, $altitude, $parsed_latitude,
    $parsed_longitude, $parsed_altitude) = request_point_params($errors);

include_once "$fnsDir/redirect.php";

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

if ($errors) {
    $_SESSION['places/add-point/errors'] = $errors;
    $_SESSION['places/add-point/values'] = [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
    ];
    redirect("./$itemQuery");
}

include_once "$fnsDir/Users/Places/addPoint.php";
Users\Places\addPoint($mysqli, $place,
    $parsed_latitude, $parsed_longitude, $parsed_altitude);

$_SESSION['places/view/messages'] = ['Changes have been saved.'];

redirect("../view/$itemQuery");
