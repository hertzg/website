<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($task, $id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['tasks/send/errors']);

include_once '../../../fns/SendForm/submitRemovePage.php';
SendForm\submitRemovePage($id, $username,
    'tasks/send/messages', 'tasks/send/values');
