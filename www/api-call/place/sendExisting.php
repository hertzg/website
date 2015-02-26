<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once 'fns/require_place.php';
$place = require_place($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_place');

include_once '../../fns/Users/Places/send.php';
Users\Places\send($mysqli, $user, $receiver_user->id_users, $place);

header('Content-Type: application/json');
echo 'true';
