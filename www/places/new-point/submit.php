<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

include_once '../fns/request_point_params.php';
list($latitude, $longitude, $altitude,
    $parsed_latitude, $parsed_longitude,
    $parsed_altitude) = request_point_params($errors, $focus);

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";

if ($errors) {
    $_SESSION['places/new-point/errors'] = $errors;
    $_SESSION['places/new-point/values'] = [
        'focus' => $focus,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
    ];
    redirect('./'.ItemList\itemQuery($id));
}

unset(
    $_SESSION['places/new-point/errors'],
    $_SESSION['places/new-point/values']
);

include_once "$fnsDir/Users/Places/Points/add.php";
$id = Users\Places\Points\add($mysqli, $place,
    $parsed_latitude, $parsed_longitude, $parsed_altitude);

$_SESSION['places/view-point/messages'] = ['Point has been saved.'];

redirect('../view-point/'.ItemList\itemQuery($id));
