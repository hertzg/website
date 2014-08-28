<?php

function require_recipient () {

    include_once __DIR__.'/../../fns/require_stage.php';
    list($user) = require_stage('../');

    include_once __DIR__.'/../../../../../fns/SendForm/NewItem/requireRecipient.php';
    $username = SendForm\NewItem\requireRecipient('contacts/new/send/values');

    return [$username, $user];

}
