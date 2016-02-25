<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_unlocked_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_unlocked_note($mysqli);

unset(
    $_SESSION['notes/send/errors'],
    $_SESSION['notes/send/messages']
);

include_once '../../fns/SendForm/submitCancelPage.php';
SendForm\submitCancelPage($id, 'notes/send/values');
