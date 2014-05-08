<?php

namespace Users\Bookmarks\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedBookmarks/deleteOnReceiver.php';
    \ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_bookmarks = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
