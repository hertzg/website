<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
$values = require_recipient($mysqli);
list($bookmark, $id, $username, $user, $recipients) = $values;

unset(
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages']
);

$base = '../../../';

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($mysqli, $user, $id, $username,
    "Bookmark #$id", 'bookmark', $recipients, $base, "{$base}contacts/");
