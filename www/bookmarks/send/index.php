<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

$key = 'bookmarks/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'recipients' => [],
        'username' => '',
    ];
}

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Bookmark #$id", $values);
