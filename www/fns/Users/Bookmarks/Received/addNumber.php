<?php

namespace Users\Bookmarks\Received;

function addNumber ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_bookmarks = num_received_bookmarks + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
