<?php

function require_bookmark ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Bookmarks/get.php";
    $bookmark = Users\Bookmarks\get($mysqli, $user, $id);

    if (!$bookmark) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('BOOKMARK_NOT_FOUND');
    }

    return $bookmark;

}
