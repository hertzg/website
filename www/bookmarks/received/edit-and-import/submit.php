<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli, '../');

include_once '../../fns/request_bookmark_params.php';
list($url, $title, $tags,
    $tag_names) = request_bookmark_params($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['bookmarks/received/edit-and-import/errors'] = $errors;
    $_SESSION['bookmarks/received/edit-and-import/values'] = [
        'focus' => $focus,
        'url' => $url,
        'title' => $title,
        'tags' => $tags,
    ];
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset(
    $_SESSION['bookmarks/received/edit-and-import/errors'],
    $_SESSION['bookmarks/received/edit-and-import/values']
);

$receivedBookmark->url = $url;
$receivedBookmark->title = $title;
$receivedBookmark->tags = $tags;

include_once "$fnsDir/Users/Bookmarks/Received/import.php";
Users\Bookmarks\Received\import($mysqli, $receivedBookmark);

$messages = ['Bookmark has been imported.'];

if ($user->num_received_bookmarks == 1) {
    $messages[] = 'No more received bookmarks.';
    $_SESSION['bookmarks/messages'] = $messages;
    unset($_SESSION['bookmarks/errors']);
    redirect('../..');
}

unset($_SESSION['bookmarks/received/errors']);
$_SESSION['bookmarks/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
