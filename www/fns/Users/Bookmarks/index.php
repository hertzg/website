<?php

namespace Users\Bookmarks;

function index ($mysqli, $user) {

    if (!$user->num_bookmarks) return [];

    include_once __DIR__.'/../../Bookmarks/indexOnUser.php';
    return \Bookmarks\indexOnUser($mysqli, $user->id_users);

}
