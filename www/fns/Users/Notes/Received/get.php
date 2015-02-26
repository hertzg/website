<?php

namespace Users\Notes\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_notes) return;

    include_once __DIR__.'/../../../ReceivedNotes/getOnReceiver.php';
    return \ReceivedNotes\getOnReceiver($mysqli, $user->id_users, $id);

}
