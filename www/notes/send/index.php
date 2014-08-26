<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

unset($_SESSION['notes/view/messages']);

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Note #$id",
    "Send Note #$id", 'note', 'notes/send/errors',
    'notes/send/messages', 'notes/send/values');
