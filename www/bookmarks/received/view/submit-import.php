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

include_once '../../../fns/Bookmarks/add.php';
$id_bookmarks = Bookmarks\add($mysqli, $id_users, $url, $title, $tags);

include_once '../../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $id_users, $id_bookmarks, $tag_names, $url, $title);

include_once '../../../fns/ReceivedBookmarks/delete.php';
ReceivedBookmarks\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedBookmarks.php';
Users\addNumReceivedBookmarks($mysqli, $id_users, -1);

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
