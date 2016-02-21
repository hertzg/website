<?php

namespace Users\Bookmarks\Received;

function clearNumberNew ($mysqli, $user) {
    $user->home_num_new_received_bookmarks = 0;
    $sql = 'update users set home_num_new_received_bookmarks = 0'
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
