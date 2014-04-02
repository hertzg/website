<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);
$id_users = $user->id_users;

$text = $receivedTask->text;
$top_priority = $receivedTask->top_priority;
$tags = $receivedTask->tags;

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Tasks/add.php';
$id_tasks = Tasks\add($mysqli, $id_users, $text, $top_priority, $tags);

include_once '../../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $id_users, $id_tasks,
    $tag_names, $text, $top_priority, $tags);

include_once '../../../fns/Users/addNumTasks.php';
Users\addNumTasks($mysqli, $id_users, 1);

include_once '../../../fns/ReceivedTasks/delete.php';
ReceivedTasks\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedTasks.php';
Users\addNumReceivedTasks($mysqli, $id_users, -1);

$messages = ['Task has been imported.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received tasks.';
    $_SESSION['tasks/messages'] = $messages;
    redirect('../..');
}

$_SESSION['tasks/received/messages'] = $messages;

redirect('..');
