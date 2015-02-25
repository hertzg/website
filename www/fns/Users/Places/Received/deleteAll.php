<?php

namespace Users\Places\Received;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_received_places) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedPlaces/indexOnReceiver.php";
    $receivedPlaces = \ReceivedPlaces\indexOnReceiver($mysqli, $id_users);

    if ($receivedPlaces) {
        include_once __DIR__.'/../../DeletedItems/addReceivedPlace.php';
        foreach ($receivedPlaces as $receivedPlace) {
            \Users\DeletedItems\addReceivedPlace(
                $mysqli, $receivedPlace, $apiKey);
        }
    }

    include_once "$fnsDir/ReceivedPlaces/deleteOnReceiver.php";
    \ReceivedPlaces\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_places = 0,'
        .' num_archived_received_places = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
