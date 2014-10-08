<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once 'fns/require_received_task.php';
include_once '../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once "$fnsDir/Users/Tasks/Received/archive.php";
Users\Tasks\Received\archive($mysqli, $receivedTask);

$_SESSION['tasks/received/view/messages'] = ['Task has been archived.'];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('view/'.ItemList\Received\itemQuery($id));
