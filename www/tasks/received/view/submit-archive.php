<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once '../../../fns/Users/Tasks/Received/archive.php';
Users\Tasks\Received\archive($mysqli, $receivedTask);

$_SESSION['tasks/received/view/messages'] = ['Task has been archived.'];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
