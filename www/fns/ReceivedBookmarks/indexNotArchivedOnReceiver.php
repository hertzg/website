<?php

namespace ReceivedBookmarks;

function indexNotArchivedOnReceiver ($mysqli, $receiver_id_users) {
    $sql = 'select * from received_bookmarks'
        ." where receiver_id_users = $receiver_id_users"
        .' and archived = 0 order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
