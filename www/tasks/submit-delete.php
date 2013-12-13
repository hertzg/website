<?php

include_once 'lib/require-task.php';
include_once '../fns/redirect.php';
include_once '../classes/Tasks.php';
include_once '../classes/TaskTags.php';
Tasks::delete($idusers, $id);
TaskTags::delete($id);
$_SESSION['tasks/index_messages'] = array('Task has been deleted.');
redirect();
