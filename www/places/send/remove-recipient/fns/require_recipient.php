<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_place.php';
    list($place, $id, $user) = require_place($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $values = SendForm\requireRecipient($id, 'places/send/values');
    list($username, $recipients) = $values;

    return [$place, $id, $username, $user, $recipients];

}
