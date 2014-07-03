<?php

namespace Users\Connections;

function delete ($mysqli, $connection) {

    include_once __DIR__.'/../../Connections/delete.php';
    \Connections\delete($mysqli, $connection->id);

    $id_users = $connection->id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../SubscribedChannels/deleteDisconnected.php';
    \Users\SubscribedChannels\deleteDisconnected($mysqli, $id_users);

}
