<?php

namespace Users\Calculations\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_calculations) return;

    include_once __DIR__.'/../../../ReceivedCalculations/getOnReceiver.php';
    return \ReceivedCalculations\getOnReceiver($mysqli, $user->id_users, $id);

}
