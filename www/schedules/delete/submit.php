<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once "$fnsDir/Users/Schedules/delete.php";
Users\Schedules\delete($mysqli, $user, $schedule);

unset($_SESSION['schedules/errors']);
$_SESSION['schedules/messages'] = ["Schedule #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
