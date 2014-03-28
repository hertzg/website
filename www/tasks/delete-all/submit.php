<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/Tasks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Tasks\deleteOnUser($mysqli, $idusers);

include_once '../../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $idusers);

include_once '../../fns/Users/clearNumTasks.php';
Users\clearNumTasks($mysqli, $idusers);

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = ['All tasks have been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
