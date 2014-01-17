<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-user.php';

include_once '../../classes/Tasks.php';
Tasks::deleteOnUser($idusers);

include_once '../../classes/TaskTags.php';
TaskTags::deleteOnUser($idusers);

$_SESSION['tasks/index_messages'] = array('All tasks have been deleted.');

redirect('..');
