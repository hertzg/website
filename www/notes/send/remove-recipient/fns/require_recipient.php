<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_note.php';
    list($note, $id, $user) = require_note($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $username = SendForm\requireRecipient($id, 'notes/send/values');

    return [$note, $id, $username, $user];

}
