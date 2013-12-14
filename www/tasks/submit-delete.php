<?php

include_once 'lib/require-task.php';

include_once '../classes/Tasks.php';
Tasks::delete($idusers, $id);

include_once '../classes/TaskTags.php';
TaskTags::deleteOnTask($id);

$_SESSION['tasks/index_messages'] = array('Task has been deleted.');

include_once '../fns/redirect.php';
redirect();
