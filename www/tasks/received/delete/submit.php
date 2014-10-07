<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli, '../');

include_once "$fnsDir/Users/Tasks/Received/delete.php";
Users\Tasks\Received\delete($mysqli, $receivedTask);

$messages = ['Task has been deleted.'];
include_once "$fnsDir/redirect.php";

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received task.';
    $_SESSION['tasks/messages'] = $messages;
    unset($_SESSION['tasks/errors']);
    redirect('../..');
}

$_SESSION['tasks/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect('../'.ItemList\Received\listUrl());
