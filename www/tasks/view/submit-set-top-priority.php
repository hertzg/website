<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

include_once '../../fns/Tasks/setTopPriority.php';
Tasks\setTopPriority($mysqli, $user->idusers, $id, true);

include_once '../../fns/TaskTags/setTaskTopPriority.php';
TaskTags\setTaskTopPriority($mysqli, $id, true);

include_once '../../fns/redirect.php';
redirect("./?id=$id");
