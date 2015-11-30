<?php

namespace Users\Calculations\Received;

function purge ($mysqli, $receivedCalculation) {

    include_once __DIR__.'/../../../ReceivedCalculations/delete.php';
    \ReceivedCalculations\delete($mysqli, $receivedCalculation->id);

    $id_users = $receivedCalculation->receiver_id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    if ($receivedCalculation->archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $id_users, -1);
    }

}
