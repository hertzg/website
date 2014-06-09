<?php

function require_task ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    include_once "$fnsDir/Tasks/getOnUser.php";
    $task = Tasks\getOnUser($mysqli, $user->id_users, $id);

    if (!$task) {
        unset($_SESSION['tasks/messages']);
        $_SESSION['tasks/errors'] = [
            'The task no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$task, $task->id_tasks, $user];

}
