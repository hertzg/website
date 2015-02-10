<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_place');

include_once 'fns/request_place_params.php';
list($latitude, $longitude, $name, $tags, $tag_names) = request_place_params();

include_once '../../fns/Users/Places/Received/add.php';
Users\Places\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $latitude, $longitude, $name, $tags);

header('Content-Type: application/json');
echo 'true';
