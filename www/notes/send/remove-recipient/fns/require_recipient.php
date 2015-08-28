<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_decrypted_note.php';
    list($note, $id, $user) = require_decrypted_note($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $values = SendForm\requireRecipient($id, 'notes/send/values');
    list($username, $recipients) = $values;

    return [$note, $id, $username, $user, $recipients];

}
