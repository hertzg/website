<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/request_strings.php';
list($done) = request_strings('done');

$done = (bool)$done;

include_once '../../fns/Tasks/setDone.php';
Tasks\setDone($mysqli, $idusers, $id, $done);

include_once '../../fns/TaskTags/setTaskDone.php';
TaskTags\setTaskDone($mysqli, $id, $done);

redirect("./?id=$id");
