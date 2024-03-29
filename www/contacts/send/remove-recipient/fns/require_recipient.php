<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_contact.php';
    list($contact, $id, $user) = require_contact($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $values = SendForm\requireRecipient($id, 'contacts/send/values');
    list($username, $recipients) = $values;

    return [$contact, $id, $username, $user, $recipients];

}
