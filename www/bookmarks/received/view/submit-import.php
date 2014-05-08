<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);
$id_users = $user->id_users;

$url = $receivedBookmark->url;
$title = $receivedBookmark->title;
$tags = $receivedBookmark->tags;

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Users/Bookmarks/add.php';
Users\Bookmarks\add($mysqli, $id_users, $url, $title, $tags, $tag_names);

include_once '../../../fns/Users/Bookmarks/Received/delete.php';
Users\Bookmarks\Received\delete($mysqli, $id_users, $id);

$messages = ['Bookmark has been imported.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_bookmarks == 1) {
    $messages[] = 'No more received bookmarks.';
    $_SESSION['bookmarks/messages'] = $messages;
    unset($_SESSION['bookmarks/errors']);
    redirect('../..');
}

$_SESSION['bookmarks/received/messages'] = $messages;

redirect('..');
