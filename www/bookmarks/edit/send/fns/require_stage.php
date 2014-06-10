<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_bookmark.php';
    list($bookmark, $id, $user) = require_bookmark($mysqli, '../');

    $key = 'bookmarks/edit/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("../?id=$id");
    }

    return [$user, $_SESSION[$key], $id];

}
