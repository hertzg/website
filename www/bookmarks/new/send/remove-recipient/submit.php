<?php

include_once '../fns/require_stage.php';
list($user) = require_stage();

include_once '../../../../fns/SendForm/NewItem/requireRecipient.php';
$username = SendForm\NewItem\requireRecipient('bookmarks/new/send/values');

unset($_SESSION['bookmarks/new/send/errors']);

include_once '../../../../fns/SendForm/NewItem/submitRemovePage.php';
SendForm\NewItem\submitRemovePage($username,
    'bookmarks/new/send/messages', 'bookmarks/new/send/values');
