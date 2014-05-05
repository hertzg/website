<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../../fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params($errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/received/edit-and-import/errors'] = $errors;
    $_SESSION['tasks/received/edit-and-import/values'] = [
        'text' => $text,
        'tags' => $tags,
        'top_priority' => $top_priority,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['tasks/received/edit-and-import/errors'],
    $_SESSION['tasks/received/edit-and-import/values']
);

include_once '../../../fns/Users/Tasks/add.php';
Users\Tasks\add($mysqli, $id_users, $text, $top_priority, $tags, $tag_names);

include_once '../../../fns/ReceivedTasks/delete.php';
ReceivedTasks\delete($mysqli, $id);

include_once '../../../fns/Users/Tasks/Received/addNumber.php';
Users\Tasks\Received\addNumber($mysqli, $id_users, -1);

$messages = ['Task has been imported.'];

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received tasks.';
    $_SESSION['tasks/messages'] = $messages;
    unset($_SESSION['tasks/errors']);
    redirect('../..');
}

$_SESSION['tasks/received/messages'] = $messages;
redirect('..');
