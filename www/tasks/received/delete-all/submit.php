<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_tasks.php';
$user = require_received_tasks('../');
$id_users = $user->id_users;

include_once '../../../fns/ReceivedTasks/deleteOnReceiver.php';
include_once '../../../lib/mysqli.php';
ReceivedTasks\deleteOnReceiver($mysqli, $id_users);

include_once '../../../fns/Users/clearNumReceivedTasks.php';
Users\clearNumReceivedTasks($mysqli, $id_users);

unset($_SESSION['tasks/errors']);
$_SESSION['tasks/messages'] = [
    'All received tasks have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('../..');
