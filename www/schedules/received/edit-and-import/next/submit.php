<?php

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_first_stage.php';
list($user, $id, $receivedSchedule, $first_stage) = require_first_stage();

include_once "$fnsDir/Schedules/requestSecondStage.php";
$days_left = Schedules\requestSecondStage($first_stage['interval']);

$interval = $first_stage['interval'];

include_once "$fnsDir/user_day.php";
$offset = (user_day($user) + $days_left) % $interval;

$receivedSchedule->text = $first_stage['text'];
$receivedSchedule->interval = $first_stage['interval'];
$receivedSchedule->offset = $offset;
$receivedSchedule->tags = $first_stage['tags'];

include_once "$fnsDir/Users/Schedules/Received/import.php";
include_once '../../../../lib/mysqli.php';
Users\Schedules\Received\import($mysqli, $user, $receivedSchedule);

$messages = ['Schedule has been imported.'];

include_once "$fnsDir/redirect.php";

if ($user->num_received_schedules == 1) {
    $messages[] = 'No more received schedules.';
    $_SESSION['schedules/messages'] = $messages;
    unset($_SESSION['schedules/errors']);
    redirect('../../..');
}

unset($_SESSION['schedules/received/errors']);
$_SESSION['schedules/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../../'));
