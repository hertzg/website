<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$checkFunction = function ($username, &$errors) use ($mysqli, $user) {
    include_once '../fns/check_receiver.php';
    check_receiver($mysqli, $user->id_users,
        $username, $receiver_id_users, $errors);
};

include_once '../../fns/SendForm/submitAddPage.php';
SendForm\submitAddPage($mysqli, $user, $id, 'bookmarks/send/errors',
    'bookmarks/send/messages', 'bookmarks/send/values', $checkFunction);
