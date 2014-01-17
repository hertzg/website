<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-task.php';
include_once '../fns/request_strings.php';

list($done) = request_strings('done');

$done = (bool)$done;

include_once '../classes/Tasks.php';
Tasks::setDone($idusers, $id, $done);

include_once '../classes/TaskTags.php';
TaskTags::setTaskDone($id, $done);

redirect("view/?id=$id");
