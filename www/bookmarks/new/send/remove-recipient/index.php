<?php

include_once '../fns/require_stage.php';
list($user) = require_stage();

include_once '../../../../fns/SendForm/NewItem/requireRecipient.php';
$username = SendForm\NewItem\requireRecipient('bookmarks/new/send/values');

unset(
    $_SESSION['bookmarks/new/send/errors'],
    $_SESSION['bookmarks/new/send/messages']
);

include_once '../../../../fns/SendForm/NewItem/removeRecipientPage.php';
SendForm\NewItem\removeRecipientPage($user, $username);
