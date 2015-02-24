<?php

namespace Users\Files\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_files) return [];

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFiles/Committed/indexOnReceiver.php";
    return \ReceivedFiles\Committed\indexOnReceiver(
        $mysqli, $user->id_users);


}
