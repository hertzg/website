<?php

namespace Users\Bookmarks\Received;

function deleteAll ($mysqli, $receiver_id_users) {

    include_once __DIR__.'/../../../ReceivedBookmarks/deleteOnReceiver.php';
    \ReceivedBookmarks\deleteOnReceiver($mysqli, $receiver_id_users);

    $sql = 'update users set num_received_bookmarks = 0'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
