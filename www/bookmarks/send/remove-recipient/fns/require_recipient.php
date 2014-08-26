<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_bookmark.php';
    list($bookmark, $id, $user) = require_bookmark($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $username = SendForm\requireRecipient($id, 'bookmarks/send/values');

    return [$bookmark, $id, $username, $user];

}
