<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/Tasks/delete.php';
Tasks\delete($mysqli, $id);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/Users/addNumTasks.php';
Users\addNumTasks($mysqli, $idusers, -1);

$_SESSION['tasks/index_messages'] = array('Task has been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
