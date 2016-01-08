<?php

namespace Users\Bookmarks\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_bookmarks = num_received_bookmarks + $num,"
        .' num_archived_received_bookmarks'
        ." = num_archived_received_bookmarks + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
