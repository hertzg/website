<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../fns/require_computable_calculation.php';
    list($calculation, $id, $user) = require_computable_calculation(
        $mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $values = SendForm\requireRecipient($id, 'calculations/send/values');
    list($username, $recipients) = $values;

    return [$calculation, $id, $username, $user, $recipients];

}
