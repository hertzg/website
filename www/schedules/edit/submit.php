<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../fns/request_first_stage.php';
list($text, $interval, $tags, $tag_names) = request_first_stage($errors);

include_once '../../fns/redirect.php';

$_SESSION['schedules/edit/values'] = [
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
];

if ($errors) {
    $_SESSION['schedules/edit/errors'] = $errors;
    redirect("./?id=$id");
}

unset($_SESSION['schedules/edit/errors']);

$_SESSION['schedules/edit/next/first_stage'] = [
    'schedule' => $schedule,
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
    'tag_names' => $tag_names,
];

include_once '../../fns/ItemList/itemQuery.php';
redirect('next/'.ItemList\itemQuery($id));
