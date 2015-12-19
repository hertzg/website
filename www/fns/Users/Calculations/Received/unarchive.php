<?php

namespace Users\Calculations\Received;

function unarchive ($mysqli, $receivedCalculation) {

    if (!$receivedCalculation->archived) return;

    include_once __DIR__.'/../../../ReceivedCalculations/setArchived.php';
    \ReceivedCalculations\setArchived($mysqli, $receivedCalculation->id, false);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedCalculation->receiver_id_users, -1);

}
