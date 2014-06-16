<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

$errors = [];

include_once '../../fns/request_bookmark_params.php';
list($url, $title, $tags, $tag_names) = request_bookmark_params($errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/received/edit-and-import/errors'] = $errors;
    $_SESSION['bookmarks/received/edit-and-import/values'] = [
        'url' => $url,
        'title' => $title,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['bookmarks/received/edit-and-import/errors'],
    $_SESSION['bookmarks/received/edit-and-import/values']
);

include_once '../../../fns/Users/Bookmarks/add.php';
Users\Bookmarks\add($mysqli, $user->id_users, $url, $title, $tags, $tag_names);

include_once '../../../fns/Users/Bookmarks/Received/purge.php';
Users\Bookmarks\Received\purge($mysqli, $receivedBookmark);

unset(
    $_SESSION['bookmarks/received/edit-and-import/errors'],
    $_SESSION['bookmarks/received/edit-and-import/values']
);

$messages = ['Bookmark has been imported.'];

if ($user->num_received_bookmarks == 1) {
    $messages[] = 'No more received bookmarks.';
    $_SESSION['bookmarks/messages'] = $messages;
    unset($_SESSION['bookmarks/errors']);
    redirect('../..');
}

$_SESSION['bookmarks/received/messages'] = $messages;
redirect('..');
