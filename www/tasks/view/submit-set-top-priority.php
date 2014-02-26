<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/request_strings.php';
list($top_priority) = request_strings('top_priority');

$top_priority = (bool)$top_priority;

include_once '../../fns/Tasks/setTopPriority.php';
Tasks\setTopPriority($mysqli, $idusers, $id, $top_priority);

include_once '../../fns/TaskTags/setTaskTopPriority.php';
TaskTags\setTaskTopPriority($mysqli, $id, $top_priority);

redirect("./?id=$id");
