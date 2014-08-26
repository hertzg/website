<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_task.php';
    list($task, $id, $user) = require_task($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $username = SendForm\requireRecipient($id, 'tasks/send/values');

    return [$task, $id, $username, $user];

}
