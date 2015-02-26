<?php

namespace Users\Files\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_files) return;

    include_once __DIR__.'/../../../ReceivedFiles/Committed/getOnReceiver.php';
    return \ReceivedFiles\Committed\getOnReceiver(
        $mysqli, $user->id_users, $id);

}
