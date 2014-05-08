<?php

namespace Users\Connections;

function delete ($mysqli, $connection) {

    include_once __DIR__.'/../../Connections/delete.php';
    \Connections\delete($mysqli, $connection->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $connection->id_users, -1);

}
