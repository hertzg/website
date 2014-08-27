<?php

include_once 'fns/require_recipient.php';
list($username, $user) = require_recipient();

unset($_SESSION['tasks/new/send/errors']);

include_once '../../../../fns/SendForm/NewItem/submitRemovePage.php';
SendForm\NewItem\submitRemovePage($username,
    'tasks/new/send/messages', 'tasks/new/send/values');
