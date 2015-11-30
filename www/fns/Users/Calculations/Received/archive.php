<?php

namespace Users\Calculations\Received;

function archive ($mysqli, $receivedCalculation) {

    if ($receivedCalculation->archived) return;

    include_once __DIR__.'/../../../ReceivedCalculations/setArchived.php';
    \ReceivedCalculations\setArchived($mysqli, $receivedCalculation->id, true);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedCalculation->receiver_id_users, 1);

}
