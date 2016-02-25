<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_schedule.php';
include_once '../../../lib/mysqli.php';
list($receivedSchedule, $id, $user) = require_received_schedule($mysqli, '../');

include_once '../../fns/request_first_stage.php';
list($text, $interval, $tags,
    $tag_names) = request_first_stage($errors, $focus);

include_once "$fnsDir/redirect.php";

$_SESSION['schedules/received/edit-and-import/values'] = [
    'focus' => $focus,
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
];

if ($errors) {
    $_SESSION['schedules/received/edit-and-import/errors'] = $errors;
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset($_SESSION['schedules/received/edit-and-import/errors']);

$_SESSION['schedules/received/edit-and-import/next/first_stage'] = [
    'receivedSchedule' => $receivedSchedule,
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
    'tag_names' => $tag_names,
];

include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('next/'.ItemList\Received\itemQuery($id));
