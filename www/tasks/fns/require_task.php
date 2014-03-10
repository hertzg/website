<?php

function require_task ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    include_once __DIR__.'/../../fns/Tasks/get.php';
    $task = Tasks\get($mysqli, $user->idusers, $id);

    if (!$task) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return array($task, $task->idtasks, $user);

}
