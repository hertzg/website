<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_schedule.php';
include_once '../../lib/mysqli.php';
list($receivedSchedule, $id, $user) = require_received_schedule($mysqli);

include_once "$fnsDir/Users/Schedules/Received/import.php";
Users\Schedules\Received\import($mysqli, $user, $receivedSchedule);

$messages = ['Schedule has been imported.'];
include_once "$fnsDir/redirect.php";

if ($user->num_received_schedules == 1) {
    $messages[] = 'No more received schedules.';
    $_SESSION['schedules/messages'] = $messages;
    unset($_SESSION['schedules/errors']);
    redirect('..');
}

unset($_SESSION['schedules/received/errors']);
$_SESSION['schedules/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl());
