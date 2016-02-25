<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_first_stage.php';
list($user, $id, $schedule, $first_stage) = require_first_stage();

include_once "$fnsDir/Schedules/requestSecondStage.php";
$days_left = Schedules\requestSecondStage($first_stage['interval']);

$interval = $first_stage['interval'];

include_once "$fnsDir/user_day.php";
$offset = (user_day($user) + $days_left) % $interval;

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

include_once "$fnsDir/request_strings.php";
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['schedules/edit/send/schedule'] = [
        'text' => $first_stage['text'],
        'interval' => $first_stage['interval'],
        'tags' => $first_stage['tags'],
        'offset' => $offset,
    ];
    unset(
        $_SESSION['schedules/edit/send/errors'],
        $_SESSION['schedules/edit/send/messages'],
        $_SESSION['schedules/edit/send/values']
    );
    redirect("../send/$itemQuery");
}

include_once "$fnsDir/Users/Schedules/edit.php";
include_once '../../../lib/mysqli.php';
Users\Schedules\edit($mysqli, $user,
    $schedule, $first_stage['text'], $interval, $offset,
    $first_stage['tags'], $first_stage['tag_names'], $changed);

unset(
    $_SESSION['schedules/edit/values'],
    $_SESSION['schedules/edit/next/first_stage']
);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['schedules/view/messages'] = [$message];

redirect("../../view/$itemQuery");
