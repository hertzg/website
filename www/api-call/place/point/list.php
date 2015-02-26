<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_places');

include_once '../fns/require_place.php';
$place = require_place($mysqli, $user);

include_once '../../../fns/PlacePoints/indexOnPlace.php';
$points = PlacePoints\indexOnPlace($mysqli, $place->id);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $points));
