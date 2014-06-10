<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_task.php';
    list($task, $id, $user) = require_task($mysqli, '../');

    $key = 'tasks/edit/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("../?id=$id");
    }

    return [$user, $_SESSION[$key], $id];

}
