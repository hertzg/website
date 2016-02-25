<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Bookmark #$id",
    "Send Bookmark #$id", 'bookmark', 'bookmarks/send/errors',
    'bookmarks/send/messages', 'bookmarks/send/values');
