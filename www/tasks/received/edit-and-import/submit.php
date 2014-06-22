<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

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

$receivedTask->text = $text;
$receivedTask->tags = $tags;
$receivedTask->top_priority = $top_priority;

include_once '../../../fns/Users/Tasks/Received/import.php';
Users\Tasks\Received\import($mysqli, $receivedTask);

$messages = ['Task has been imported.'];

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received tasks.';
    $_SESSION['tasks/messages'] = $messages;
    unset($_SESSION['tasks/errors']);
    redirect('../..');
}

$_SESSION['tasks/received/messages'] = $messages;
redirect('..');
