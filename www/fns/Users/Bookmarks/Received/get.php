<?php

namespace Users\Bookmarks\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_bookmarks) return;

    include_once __DIR__.'/../../../ReceivedBookmarks/getOnReceiver.php';
    return \ReceivedBookmarks\getOnReceiver($mysqli, $user->id_users, $id);

}
