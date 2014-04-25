<?php

function require_task ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    include_once __DIR__.'/../../fns/Tasks/getOnUser.php';
    $task = Tasks\getOnUser($mysqli, $user->id_users, $id);

    if (!$task) {
        unset($_SESSION['tasks/messages']);
        $_SESSION['tasks/errors'] = [
            'The task no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$task, $task->id_tasks, $user];

}
