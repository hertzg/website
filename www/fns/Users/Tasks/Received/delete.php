<?php

namespace Users\Tasks\Received;

function delete ($mysqli, $receivedTask) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedTask);

    include_once __DIR__.'/../../DeletedItems/addReceivedTask.php';
    \Users\DeletedItems\addReceivedTask($mysqli, $receivedTask);

}
