<?php

include_once '../../../../lib/defaults.php';

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

include_once "$fnsDir/redirect.php";

include_once "$fnsDir/request_strings.php";
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['schedules/new/send/schedule'] = [
        'text' => $first_stage['text'],
        'interval' => $first_stage['interval'],
        'tags' => $first_stage['tags'],
        'offset' => $offset,
    ];
    unset(
        $_SESSION['schedules/new/send/errors'],
        $_SESSION['schedules/new/send/messages'],
        $_SESSION['schedules/new/send/values']
    );
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('../send/'.ItemList\pageQuery());
}

include_once "$fnsDir/Users/Schedules/add.php";
include_once '../../../lib/mysqli.php';
$id = Users\Schedules\add($mysqli, $user, $first_stage['text'],
    $interval, $offset, $first_stage['tags'], $first_stage['tag_names']);

unset(
    $_SESSION['schedules/new/values'],
    $_SESSION['schedules/new/next/first_stage']
);

$_SESSION['schedules/view/messages'] = ['Schedule has been saved.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../../view/'.ItemList\itemQuery($id));
