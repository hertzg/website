<?php

namespace Users\Calculations\Received;

function purge ($mysqli, $receivedCalculation) {

    include_once __DIR__.'/../../../ReceivedCalculations/delete.php';
    \ReceivedCalculations\delete($mysqli, $receivedCalculation->id);

    $id_users = $receivedCalculation->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedCalculation->archived ? -1 : 0);

}
