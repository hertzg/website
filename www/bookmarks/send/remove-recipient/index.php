<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($bookmark, $id, $username, $user) = require_recipient($mysqli);

unset(
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($user, $id, $username, "Bookmark #$id");
