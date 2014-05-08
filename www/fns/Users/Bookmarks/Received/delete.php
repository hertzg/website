<?php

namespace Users\Bookmarks\Received;

function delete ($mysqli, $receiver_id_users, $id) {

    include_once __DIR__.'/../../../ReceivedBookmarks/delete.php';
    \ReceivedBookmarks\delete($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, -1);

}
