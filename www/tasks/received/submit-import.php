<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_task.php';
include_once '../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once "$fnsDir/Users/Tasks/Received/import.php";
Users\Tasks\Received\import($mysqli, $user, $receivedTask);

$messages = ['Task has been imported.'];
include_once "$fnsDir/redirect.php";

if ($user->num_received_tasks == 1) {
    $messages[] = 'No more received tasks.';
    $_SESSION['tasks/messages'] = $messages;
    unset($_SESSION['tasks/errors']);
    redirect('..');
}

unset($_SESSION['tasks/received/errors']);
$_SESSION['tasks/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl());
