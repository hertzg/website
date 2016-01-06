<?php

namespace Users\Places\Received;

function purge ($mysqli, $receivedPlace) {

    include_once __DIR__.'/../../../ReceivedPlaces/delete.php';
    \ReceivedPlaces\delete($mysqli, $receivedPlace->id);

    $id_users = $receivedPlace->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedPlace->archived ? -1 : 0);

}
