<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_schedule.php';
include_once '../../lib/mysqli.php';
list($receivedSchedule, $id, $user) = require_received_schedule($mysqli);

include_once "$fnsDir/Users/Schedules/Received/archive.php";
Users\Schedules\Received\archive($mysqli, $receivedSchedule);

$_SESSION['schedules/received/view/messages'] = ['Schedule has been archived.'];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('view/'.ItemList\Received\itemQuery($id));
