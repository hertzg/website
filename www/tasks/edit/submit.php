<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

include_once '../fns/request_task_params.php';
list($text, $deadline_day, $deadline_month,
    $deadline_year, $deadline_time, $tags, $tag_names,
    $top_priority) = request_task_params($user, $errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

$values = [
    'focus' => $focus,
    'text' => $text,
    'deadline_day' => $deadline_day,
    'deadline_month' => $deadline_month,
    'deadline_year' => $deadline_year,
    'deadline_time' => $deadline_time,
    'tags' => $tags,
    'top_priority' => $top_priority,
];

$_SESSION['tasks/edit/values'] = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['tasks/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['tasks/edit/errors']);

include_once "$fnsDir/request_strings.php";
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['tasks/edit/send/errors'],
        $_SESSION['tasks/edit/send/messages'],
        $_SESSION['tasks/edit/send/values']
    );
    $_SESSION['tasks/edit/send/task'] = $values;
    redirect("send/$itemQuery");
}

unset($_SESSION['tasks/edit/values']);

include_once "$fnsDir/Users/Tasks/edit.php";
Users\Tasks\edit($mysqli, $user, $task, $text,
    $deadline_time, $tags, $tag_names, $top_priority, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['tasks/view/messages'] = [$message];

redirect("../view/$itemQuery");
