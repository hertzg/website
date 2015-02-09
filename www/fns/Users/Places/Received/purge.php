<?php

namespace Users\Places\Received;

function purge ($mysqli, $receivedPlace) {

    include_once __DIR__.'/../../../ReceivedPlaces/delete.php';
    \ReceivedPlaces\delete($mysqli, $receivedPlace->id);

    $id_users = $receivedPlace->receiver_id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    if ($receivedPlace->archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $id_users, -1);
    }

}
