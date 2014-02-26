<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/Tasks/setTopPriority.php';
Tasks\setTopPriority($mysqli, $idusers, $id, false);

include_once '../../fns/TaskTags/setTaskTopPriority.php';
TaskTags\setTaskTopPriority($mysqli, $id, false);

redirect("./?id=$id");
