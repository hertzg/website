<?php

include_once 'fns/require_recipient.php';
list($username, $user) = require_recipient();

unset(
    $_SESSION['bookmarks/new/send/errors'],
    $_SESSION['bookmarks/new/send/messages']
);

include_once '../../../../fns/SendForm/NewItem/removeRecipientPage.php';
SendForm\NewItem\removeRecipientPage($user, $username);
