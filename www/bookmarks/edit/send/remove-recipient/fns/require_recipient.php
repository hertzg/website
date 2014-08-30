<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../fns/require_stage.php';
    list($user, $stageValues, $id) = require_stage($mysqli, '../');

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/SendForm/EditItem/requireRecipient.php";
    $valuesKey = 'bookmarks/edit/send/values';
    $username = SendForm\EditItem\requireRecipient($id, $valuesKey);

    return [$id, $username, $user];

}
