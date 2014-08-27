<?php

include_once 'fns/require_recipient.php';
list($username, $user) = require_recipient();

unset(
    $_SESSION['notes/new/send/errors'],
    $_SESSION['notes/new/send/messages']
);

include_once '../../../../fns/SendForm/NewItem/removeRecipientPage.php';
SendForm\NewItem\removeRecipientPage($user, $username);
