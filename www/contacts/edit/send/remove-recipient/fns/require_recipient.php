<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../fns/require_stage.php';
    list($user, $stageValues, $id) = require_stage($mysqli, '../');

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/SendForm/EditItem/requireRecipient.php";
    $valuesKey = 'contacts/edit/send/values';
    $values = SendForm\EditItem\requireRecipient($id, $valuesKey);
    list($username, $recipients) = $values;

    return [$id, $username, $user, $recipients];

}
