<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($bookmark, $id, $username, $user) = require_recipient($mysqli);

$key = 'bookmarks/send/values';
if (array_key_exists($key, $_SESSION)) {
    unset($_SESSION[$key]['recipients'][$username]);
}

$_SESSION['bookmarks/send/messages'] = ['The recipient has been removed.'];
unset($_SESSION['bookmarks/send/errors']);

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/itemQuery.php';
redirect('../'.ItemList\itemQuery($id));
