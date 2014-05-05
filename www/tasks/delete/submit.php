<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

include_once '../../fns/Tasks/delete.php';
Tasks\delete($mysqli, $id);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/Users/Tasks/addNumber.php';
Users\Tasks\addNumber($mysqli, $user->id_users, -1);

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = ['Task has been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
