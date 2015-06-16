<?php

namespace Users\Bookmarks;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_bookmarks) return [];

    include_once __DIR__.'/../../Bookmarks/searchPage.php';
    return \Bookmarks\searchPage($mysqli,
        $user->id_users,$keyword, $offset, $limit, $total);

}
