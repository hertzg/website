<?php

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($id, $username, $user) = require_recipient($mysqli);

unset(
    $_SESSION['tasks/edit/send/errors'],
    $_SESSION['tasks/edit/send/messages']
);

include_once '../../../../fns/SendForm/EditItem/removeRecipientPage.php';
SendForm\EditItem\removeRecipientPage($user, $id, $username);
