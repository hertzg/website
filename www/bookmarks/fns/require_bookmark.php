<?php

function require_bookmark ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Bookmarks/get.php';
    $bookmark = Bookmarks\get($mysqli, $user->idusers, $id);

    if (!$bookmark) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return array($bookmark, $id, $user);

}
