<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('place/send', 'can_write_places', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_place');

include_once 'fns/require_place_params.php';
require_place_params($latitude, $longitude,
    $altitude, $name, $description, $tags, $tag_names);

include_once '../../fns/Users/Places/Received/add.php';
Users\Places\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $latitude, $longitude,
    $altitude, $name, $description, $tags);

header('Content-Type: application/json');
echo 'true';
