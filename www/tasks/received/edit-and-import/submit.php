<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

$errors = [];

include_once '../../fns/request_task_params.php';
$values = request_task_params($user, $errors);
list($text, $deadline_day, $deadline_month, $deadline_year,
    $deadline_time, $tags, $tag_names, $top_priority) = $values;

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/received/edit-and-import/errors'] = $errors;
    $_SESSION['tasks/received/edit-and-import/values'] = [
        'text' => $text,
        'deadline_day' => $deadline_day,
        'deadline_month' => $deadline_month,
        'deadline_year' => $deadline_year,
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
$receivedTask->deadline_time = $deadline_time;
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
