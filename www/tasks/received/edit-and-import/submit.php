<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($text, $top_priority, $tags) = request_strings(
    'text', 'top_priority', 'tags');

$top_priority = (bool)$top_priority;

include_once '../../../fns/str_collapse_spaces_multiline.php';
$text = str_collapse_spaces_multiline($text);

include_once '../../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($text === '') $errors[] = 'Enter URL.';

include_once '../../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/received/edit-and-import/errors'] = $errors;
    $_SESSION['tasks/received/edit-and-import/values'] = [
        'text' => $text,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

include_once '../../../fns/Tasks/add.php';
$id_tasks = Tasks\add($mysqli, $id_users, $text, $top_priority, $tags);

include_once '../../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $id_users, $id_tasks, $tag_names, $text, $top_priority, $tags);

include_once '../../../fns/Users/addNumTasks.php';
Users\addNumTasks($mysqli, $id_users, 1);

include_once '../../../fns/ReceivedTasks/delete.php';
ReceivedTasks\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedTasks.php';
Users\addNumReceivedTasks($mysqli, $id_users, -1);

unset(
    $_SESSION['tasks/received/edit-and-import/errors'],
    $_SESSION['tasks/received/edit-and-import/values']
);

$messages = ['Task has been imported.'];

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received tasks.';
    $_SESSION['tasks/messages'] = $messages;
    unset($_SESSION['tasks/errors']);
    redirect('../..');
}

$_SESSION['tasks/received/messages'] = $messages;
redirect('..');
