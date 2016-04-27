<?php

namespace Users\Bookmarks;

function searchPage ($mysqli, $user,
    $includes, $excludes, $offset, $limit, &$total) {

    if (!$user->num_bookmarks) return [];

    include_once __DIR__.'/../../Bookmarks/searchPage.php';
    return \Bookmarks\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->bookmarks_order_by);

}
