<?php

include_once 'fns/require_stage.php';
list($user) = require_stage();

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Send New Bookmark', 'bookmark', 'bookmarks/new/send/errors',
    'bookmarks/new/send/messages', 'bookmarks/new/send/values');
