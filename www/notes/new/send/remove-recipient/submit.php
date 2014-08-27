<?php

include_once 'fns/require_recipient.php';
list($username, $user) = require_recipient();

unset($_SESSION['notes/new/send/errors']);

include_once '../../../../fns/SendForm/NewItem/submitRemovePage.php';
SendForm\NewItem\submitRemovePage($username,
    'notes/new/send/messages', 'notes/new/send/values');
