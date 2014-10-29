<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_tasks.php';
$user = require_tasks();

include_once '../../fns/Users/Tasks/deleteAll.php';
include_once '../../lib/mysqli.php';
Users\Tasks\deleteAll($mysqli, $user->id_users);

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = ['All tasks have been deleted.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
