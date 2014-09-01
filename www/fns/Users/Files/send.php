<?php

namespace Users\Files;

function send ($mysqli, $user, $receiver_id_users, $file) {
    include_once __DIR__.'/sendRenamed.php';
    sendRenamed($mysqli, $user, $receiver_id_users, $file, $file->name);
}
