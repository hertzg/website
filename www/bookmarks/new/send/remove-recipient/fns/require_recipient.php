<?php

function require_recipient () {

    include_once '../fns/require_stage.php';
    list($user) = require_stage('../');

    include_once '../../../../fns/SendForm/NewItem/requireRecipient.php';
    $username = SendForm\NewItem\requireRecipient('bookmarks/new/send/values');

    return [$username, $user];

}
