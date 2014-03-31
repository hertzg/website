<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Tasks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Tasks\deleteOnUser($mysqli, $id_users);

include_once '../../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/clearNumTasks.php';
Users\clearNumTasks($mysqli, $id_users);

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = ['All tasks have been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
