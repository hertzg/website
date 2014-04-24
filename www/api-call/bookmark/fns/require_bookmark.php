<?php

function require_bookmark ($mysqli, $id_users) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Bookmarks/get.php';
    $bookmark = Bookmarks\get($mysqli, $id_users, $id);

    if (!$bookmark) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('The bookmark no longer exists.');
    }

    return [$id, $bookmark];

}
