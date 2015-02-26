<?php

namespace Users\Places\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_places) return;

    include_once __DIR__.'/../../../ReceivedPlaces/getOnReceiver.php';
    return \ReceivedPlaces\getOnReceiver($mysqli, $user->id_users, $id);

}
