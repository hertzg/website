<?php

namespace Users\Bookmarks\Received;

function addNumberArchived ($mysqli, $id_users, $n) {
    $sql = 'update users set num_archived_received_bookmarks ='
        ." num_archived_received_bookmarks + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli);
}
