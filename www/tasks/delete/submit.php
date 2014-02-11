<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-task.php';

include_once '../../fns/Tasks/delete.php';
include_once '../../lib/mysqli.php';
Tasks\delete($mysqli, $id);

include_once '../../classes/TaskTags.php';
TaskTags::deleteOnTask($id);

$_SESSION['tasks/index_messages'] = array('Task has been deleted.');

redirect('..');
