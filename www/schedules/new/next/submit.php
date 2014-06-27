<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();
$id_users = $user->id_users;

include_once '../../../fns/Schedules/requestSecondStage.php';
$days_left = Schedules\requestSecondStage($first_stage['interval']);

$interval = $first_stage['interval'];

include_once '../../../fns/day_today.php';
$offset = (day_today() + $days_left) % $interval;

include_once '../../../fns/Users/Schedules/add.php';
include_once '../../../lib/mysqli.php';
$id = Users\Schedules\add($mysqli, $user, $first_stage['text'], $interval, $offset);

unset(
    $_SESSION['schedules/new/values'],
    $_SESSION['schedules/new/next/first_stage']
);

$_SESSION['schedules/view/messages'] = ['Schedule has been created.'];

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/itemQuery.php';
redirect('../../view/'.ItemList\itemQuery($id));
