<?php

namespace Users\Calculations\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_calculations) return [];

    include_once __DIR__.'/../../../ReceivedCalculations/indexOnReceiver.php';
    return \ReceivedCalculations\indexOnReceiver($mysqli, $user->id_users);

}
