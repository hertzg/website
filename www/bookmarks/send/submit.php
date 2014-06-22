<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $user->id_users,
    $username, $receiver_id_users, $errors);

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

include_once '../../fns/Users/Bookmarks/send.php';
Users\Bookmarks\send($mysqli, $user, $receiver_id_users, $bookmark);

$_SESSION['bookmarks/view/messages'] = ['Sent.'];
redirect("../view/$itemQuery");
