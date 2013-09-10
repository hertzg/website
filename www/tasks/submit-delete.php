<?php

include_once 'lib/require-task.php';
include_once '../fns/redirect.php';
include_once '../classes/Tasks.php';
Tasks::delete($idusers, $id);
$_SESSION['tasks/index_messages'] = array('Task has been deleted.');
redirect();
