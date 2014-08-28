<?php

function require_stage ($mysqli, $base = '') {

    include_once __DIR__.'/../../../fns/require_bookmark.php';
    list($bookmark, $id, $user) = require_bookmark($mysqli, "$base../");

    $key = 'bookmarks/edit/values';
    if (!array_key_exists($key, $_SESSION)) {
        $fnsDir = __DIR__.'/../../../../fns';
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.ItemList\itemQuery($id));
    }

    return [$user, $_SESSION[$key], $id];

}
