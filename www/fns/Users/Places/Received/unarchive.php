<?php

namespace Users\Places\Received;

function unarchive ($mysqli, $receivedPlace) {

    if (!$receivedPlace->archived) return;

    include_once __DIR__.'/../../../ReceivedPlaces/setArchived.php';
    \ReceivedPlaces\setArchived($mysqli, $receivedPlace->id, false);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedPlace->receiver_id_users, 0, -1);

}
