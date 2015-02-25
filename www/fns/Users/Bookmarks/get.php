<?php

namespace Users\Bookmarks;

function get ($mysqli, $user, $id) {

    if (!$user->num_bookmarks) return;

    include_once __DIR__.'/../../Bookmarks/getOnUser.php';
    return \Bookmarks\getOnUser($mysqli, $user->id_users, $id);

}
