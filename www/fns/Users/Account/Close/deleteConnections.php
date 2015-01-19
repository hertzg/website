<?php

namespace Users\Account\Close;

function deleteConnections ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Connections/indexOnConnectedUser.php";
    $connections = \Connections\indexOnConnectedUser($mysqli, $id_users);

    if ($connections) {
        include_once __DIR__.'/../../Connections/delete.php';
        foreach ($connections as $connection) {
            \Users\Connections\delete($mysqli, $connection);
        }
    }

    if ($user->num_connections) {
        include_once "$fnsDir/Connections/deleteOnUser.php";
        \Connections\deleteOnUser($mysqli, $id_users);
    }

}
