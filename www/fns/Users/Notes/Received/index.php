<?php

namespace Users\Notes\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_notes) return [];

    include_once __DIR__.'/../../../ReceivedNotes/indexOnReceiver.php';
    return \ReceivedNotes\indexOnReceiver($mysqli, $user->id_users);

}
