<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once '../fns/require_place.php';
$place = require_place($mysqli, $user->id_users);

$fnsDir = '../../../fns';

include_once "$fnsDir/PlacePoints/request.php";
list($latitude, $longitude, $altitude, $parsed_latitude,
    $parsed_longitude, $parsed_altitude) = PlacePoints\request();

include_once "$fnsDir/Users/Places/Points/add.php";
$id = Users\Places\Points\add($mysqli, $place,
    $parsed_latitude, $parsed_longitude, $parsed_altitude);

header('Content-Type: application/json');
echo $id;
