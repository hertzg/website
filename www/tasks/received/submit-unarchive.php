<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once 'fns/require_received_task.php';
include_once '../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

include_once "$fnsDir/Users/Tasks/Received/unarchive.php";
Users\Tasks\Received\unarchive($mysqli, $receivedTask);

$_SESSION['tasks/received/view/messages'] = ['Task has been unarchived.'];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('view/'.ItemList\Received\itemQuery($id));
