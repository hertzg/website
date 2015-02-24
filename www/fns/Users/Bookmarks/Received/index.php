<?php

namespace Users\Bookmarks\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_bookmarks) return [];

    include_once __DIR__.'/../../../ReceivedBookmarks/indexOnReceiver.php';
    return \ReceivedBookmarks\indexOnReceiver($mysqli, $user->id_users);

}
