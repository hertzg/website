<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once '../../../fns/ReceivedTasks/delete.php';
ReceivedTasks\delete($mysqli, $id);

include_once '../../../fns/Users/Tasks/Received/addNumber.php';
Users\Tasks\Received\addNumber($mysqli, $user->id_users, -1);

$messages = ['Task has been deleted.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received task.';
    $_SESSION['tasks/messages'] = $messages;
    unset($_SESSION['tasks/errors']);
    redirect('../..');
}

$_SESSION['tasks/received/messages'] = $messages;
redirect('..');
