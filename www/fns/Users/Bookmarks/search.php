<?php

namespace Users\Bookmarks;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_bookmarks) return [];

    include_once __DIR__.'/../../Bookmarks/search.php';
    return \Bookmarks\search($mysqli, $user->id_users, $keyword);

}
