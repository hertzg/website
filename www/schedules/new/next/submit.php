<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();

include_once "$fnsDir/Schedules/requestSecondStage.php";
$days_left = Schedules\requestSecondStage($first_stage['interval']);

$interval = $first_stage['interval'];

include_once "$fnsDir/user_day.php";
$offset = (user_day($user) + $days_left) % $interval;

include_once "$fnsDir/Users/Schedules/add.php";
include_once '../../../lib/mysqli.php';
$id = Users\Schedules\add($mysqli, $user, $first_stage['text'],
    $interval, $offset, $first_stage['tags'], $first_stage['tag_names']);

unset(
    $_SESSION['schedules/new/values'],
    $_SESSION['schedules/new/next/first_stage']
);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../../view/'.ItemList\itemQuery($id));
