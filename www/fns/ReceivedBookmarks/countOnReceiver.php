<?php

namespace ReceivedBookmarks;

function countOnReceiver ($mysqli, $receiver_id_users) {
    $sql = "select count(*) value from received_bookmarks"
        ." where receiver_id_users = $receiver_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
