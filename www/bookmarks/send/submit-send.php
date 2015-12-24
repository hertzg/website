<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $bookmark, $user, $fnsDir) {

    include_once "$fnsDir/Users/Bookmarks/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Bookmarks\send($mysqli, $user, $receiver_id_users, $bookmark);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $bookmark, $user, $fnsDir) {

    include_once "$fnsDir/SendingBookmarks/add.php";
    foreach ($recipients as $recipient) {
        SendingBookmarks\add($mysqli, $user->id_users, $user->username,
            $recipient['username'], $recipient['address'],
            $recipient['id_admin_connections'],
            $recipient['their_exchange_api_key'], $bookmark->url,
            $bookmark->title, $bookmark->tags);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($mysqli, $user, $id,
    'bookmarks/send/errors', 'bookmarks/send/messages',
    'bookmarks/send/values', 'bookmarks/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
