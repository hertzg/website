<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-user.php';

include_once '../../fns/Tasks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Tasks\deleteOnUser($mysqli, $idusers);

include_once '../../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $idusers);

$_SESSION['tasks/index_messages'] = array('All tasks have been deleted.');

redirect('..');
