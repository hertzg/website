<?php

namespace Users\Bookmarks\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_bookmarks = num_received_bookmarks + $n,"
        .' home_num_new_received_bookmarks'
        ." = home_num_new_received_bookmarks + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
