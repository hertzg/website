<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../fns/request_first_stage.php';
list($text, $interval, $tags,
    $tag_names) = request_first_stage($errors, $focus);

include_once "$fnsDir/redirect.php";

$_SESSION['schedules/edit/values'] = [
    'focus' => $focus,
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
];

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

if ($errors) {
    $_SESSION['schedules/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['schedules/edit/errors']);

$_SESSION['schedules/edit/next/first_stage'] = [
    'schedule' => $schedule,
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
    'tag_names' => $tag_names,
];

redirect("next/$itemQuery");
