<?php

include_once 'fns/require_stage.php';
list($user) = require_stage();

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Send New Note', 'note', 'notes/new/send/errors',
    'notes/new/send/messages', 'notes/new/send/values');
