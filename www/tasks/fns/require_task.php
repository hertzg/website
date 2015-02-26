<?php

function require_task ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Tasks/get.php";
    $task = Users\Tasks\get($mysqli, $user, $id);

    if (!$task) {
        unset($_SESSION['tasks/messages']);
        $_SESSION['tasks/errors'] = ['The task no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$task, $task->id, $user];

}
