<?php

namespace Users\Places\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_places) return [];

    include_once __DIR__.'/../../../ReceivedPlaces/indexOnReceiver.php';
    return \ReceivedPlaces\indexOnReceiver($mysqli, $user->id_users);

}
