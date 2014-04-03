<?php

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($url, $title, $tags) = request_strings('url', 'title', 'tags');

include_once '../../../fns/str_collapse_spaces.php';
$title = str_collapse_spaces($title);
$url = str_collapse_spaces($url);
$tags = str_collapse_spaces($tags);

$errors = [];

if ($url === '') $errors[] = 'Enter URL.';

include_once '../../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

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

include_once '../../../fns/Bookmarks/add.php';
$id_bookmarks = Bookmarks\add($mysqli, $id_users, $url, $title, $tags);

include_once '../../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $id_users, $id_bookmarks, $tag_names, $url, $title);

include_once '../../../fns/Users/addNumBookmarks.php';
Users\addNumBookmarks($mysqli, $id_users, 1);

include_once '../../../fns/ReceivedBookmarks/delete.php';
ReceivedBookmarks\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedBookmarks.php';
Users\addNumReceivedBookmarks($mysqli, $id_users, -1);

$messages = ['Bookmark has been imported.'];

if ($user->num_received_bookmarks == 1) {
    $messages[] = 'No more received bookmarks.';
    $_SESSION['bookmarks/messages'] = $messages;
    redirect('../..');
}

$_SESSION['bookmarks/received/messages'] = $messages;
redirect('..');
