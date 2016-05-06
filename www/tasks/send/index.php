<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset($_SESSION['tasks/view/messages']);

$base = '../../';

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Task #$id",
    "Send Task #$id", 'task', 'tasks/send/errors',
    'tasks/send/messages', 'tasks/send/values',
    $base, "{$base}contacts/");
