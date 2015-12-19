<?php

namespace Users\Calculations\Received;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_received_calculations) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedCalculations/indexOnReceiver.php";
    $receivedCalculations = \ReceivedCalculations\indexOnReceiver(
        $mysqli, $id_users);

    if ($receivedCalculations) {
        include_once __DIR__.'/../../DeletedItems/addReceivedCalculation.php';
        foreach ($receivedCalculations as $receivedCalculation) {
            \Users\DeletedItems\addReceivedCalculation(
                $mysqli, $receivedCalculation, $apiKey);
        }
    }

    include_once "$fnsDir/ReceivedCalculations/deleteOnReceiver.php";
    \ReceivedCalculations\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_calculations = 0,'
        .' num_archived_received_calculations = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
