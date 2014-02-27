<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Tasks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Tasks\deleteOnUser($mysqli, $idusers);

include_once '../../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $idusers);

$_SESSION['tasks/index_messages'] = array('All tasks have been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
