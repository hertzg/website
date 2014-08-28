<?php

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($id, $username, $user) = require_recipient($mysqli);

unset(
    $_SESSION['notes/edit/send/errors'],
    $_SESSION['notes/edit/send/messages']
);

include_once '../../../../fns/SendForm/EditItem/removeRecipientPage.php';
SendForm\EditItem\removeRecipientPage($user, $id, $username);
