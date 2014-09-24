<?php

function require_recipient () {

    include_once __DIR__.'/../../fns/require_stage.php';
    list($user) = require_stage('../');

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/SendForm/NewItem/requireRecipient.php";
    $values = SendForm\NewItem\requireRecipient('bookmarks/new/send/values');
    list($username, $recipients) = $values;

    return [$username, $user, $recipients];

}
