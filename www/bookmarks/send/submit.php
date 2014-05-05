<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../fns/Users/getByUsername.php';
    $receiverUser = Users\getByUsername($mysqli, $username);
    if (!$receiverUser) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $receiver_id_users = $receiverUser->id_users;
        if ($receiver_id_users == $id_users) {
            $errors[] = 'You cannot send a bookmark to yourself.';
        } else {
            include_once '../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if (!$connection['can_send_bookmark']) {
                $errors[] = "The user isn't receiving bookmarks from you.";
            }
        }
    }
}

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/send/errors'] = $errors;
    $_SESSION['bookmarks/send/values'] = ['username' => $username];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/values']
);

include_once '../../fns/ReceivedBookmarks/add.php';
ReceivedBookmarks\add($mysqli, $id_users, $user->username, $receiver_id_users,
    $bookmark->url, $bookmark->title, $bookmark->tags);

include_once '../../fns/Users/Bookmarks/Received/addNumber.php';
Users\Bookmarks\Received\addNumber($mysqli, $receiver_id_users, 1);

$_SESSION['bookmarks/view/messages'] = ['Sent.'];

redirect("../view/$itemQuery");
