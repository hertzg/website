<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values'],
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages'],
    $_SESSION['bookmarks/send/values']
);

include_once '../fns/create_view_page.php';
$content = create_view_page($mysqli, $user, $bookmark);

include_once '../../fns/echo_page.php';
echo_page($user, "Bookmark #$id", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
