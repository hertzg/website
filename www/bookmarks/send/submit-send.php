<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use ($mysqli, $bookmark, $user) {
    include_once '../../fns/Users/Bookmarks/send.php';
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Bookmarks\send($mysqli, $user, $receiver_id_users, $bookmark);
    }
};

include_once '../../fns/SendForm/submitSendPage.php';
SendForm\submitSendPage($user, $id, 'bookmarks/send/errors',
    'bookmarks/send/messages', 'bookmarks/send/values',
    'bookmarks/view/messages', $checkFunction, $sendFunction);
