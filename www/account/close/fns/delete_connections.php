<?php

function delete_connections ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Connections/indexOnConnectedUser.php";
    $connections = Connections\indexOnConnectedUser($mysqli, $id_users);

    if ($connections) {
        include_once "$fnsDir/Users/Connections/delete.php";
        foreach ($connections as $connection) {
            Users\Connections\delete($mysqli, $connection);
        }
    }

    include_once "$fnsDir/Connections/deleteOnUser.php";
    Connections\deleteOnUser($mysqli, $id_users);

}
