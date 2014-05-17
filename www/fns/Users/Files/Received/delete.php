<?php

namespace Users\Files\Received;

function delete ($mysqli, $id_users, $id) {

    include_once __DIR__.'/../../../ReceivedFiles/delete.php';
    \ReceivedFiles\delete($mysqli, $id_users, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

}
