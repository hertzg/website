<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_places', $apiKey, $user, $mysqli);

include_once 'fns/request_place_params.php';
list($latitude, $longitude, $altitude, $name,
    $description, $tags, $tag_names) = request_place_params();

include_once '../../fns/Users/Places/add.php';
$id = Users\Places\add($mysqli, $user->id_users, $latitude,
    $longitude, $altitude, $name, $description, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo $id;
