<?php

function require_bookmark ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Bookmarks/getOnUser.php";
    $bookmark = Bookmarks\getOnUser($mysqli, $id_users, $id);

    if (!$bookmark) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('BOOKMARK_NOT_FOUND');
    }

    return $bookmark;

}
