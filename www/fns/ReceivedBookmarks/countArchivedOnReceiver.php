<?php

namespace ReceivedBookmarks;

function countArchivedOnReceiver ($mysqli, $receiver_id_users) {
    $sql = 'select count(*) value from received_bookmarks'
        ." where archived = 1 and receiver_id_users = $receiver_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
