<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_bookmark.php';
    list($bookmark, $id, $user) = require_bookmark($mysqli, '../');

    $fnsDir = __DIR__.'/../../../../fns';

    $key = 'bookmarks/send/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.ItemList\itemQuery($id));
    }

    $recipients = $_SESSION[$key]['recipients'];

    include_once __DIR__.'/../../../../fns/request_strings.php';
    list($username) = request_strings('username');
    if (!array_key_exists($username, $recipients)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.ItemList\itemQuery($id));
    }

    return [$bookmark, $id, $username, $user];

}
