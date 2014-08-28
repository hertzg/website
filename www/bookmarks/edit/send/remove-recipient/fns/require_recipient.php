<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../fns/require_stage.php';
    list($user, $stageValues, $id) = require_stage($mysqli, '../');

    include_once __DIR__.'/../../../../../fns/SendForm/EditItem/requireRecipient.php';
    $username = SendForm\EditItem\requireRecipient($id, 'bookmarks/edit/send/values');

    return [$id, $username, $user];

}
