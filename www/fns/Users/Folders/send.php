<?php

namespace Users\Folders;

function send ($mysqli, $user, $receiver_id_users, $folder) {
    include_once __DIR__.'/sendRenamed.php';
    sendRenamed($mysqli, $user, $receiver_id_users, $folder, $folder->name);
}
