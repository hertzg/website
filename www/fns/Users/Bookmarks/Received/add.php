<?php

namespace Users\Bookmarks\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $url, $title, $tags, $sender_address = null) {

    include_once __DIR__.'/../../../ReceivedBookmarks/add.php';
    \ReceivedBookmarks\add($mysqli, $sender_address, $sender_id_users,
        $sender_username, $receiver_id_users, $url, $title, $tags);

    $sql = 'update users set'
        .' num_received_bookmarks = num_received_bookmarks + 1,'
        .' home_num_new_received_bookmarks'
        .' = home_num_new_received_bookmarks + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
