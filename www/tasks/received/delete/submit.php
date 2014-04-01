<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once '../../../lib/mysqli.php';

include_once '../../../fns/ReceivedTasks/delete.php';
ReceivedTasks\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedTasks.php';
Users\addNumReceivedTasks($mysqli, $user->id_users, -1);

$_SESSION['tasks/received/messages'] = ['Note has been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
