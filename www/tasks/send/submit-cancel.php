<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset(
    $_SESSION['tasks/send/errors'],
    $_SESSION['tasks/send/messages']
);

include_once '../../fns/SendForm/submitCancelPage.php';
SendForm\submitCancelPage($id, 'tasks/send/values');
