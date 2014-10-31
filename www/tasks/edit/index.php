<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

$key = 'tasks/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    $deadline_time = $task->deadline_time;
    if ($deadline_time === null) {
        $deadline_day = $deadline_month = $deadline_year = 0;
    } else {
        $deadline_day = date('d', $deadline_time);
        $deadline_month = date('n', $deadline_time);
        $deadline_year = date('Y', $deadline_time);
    }

    $values = [
        'text' => $task->text,
        'deadline_day' => $deadline_day,
        'deadline_month' => $deadline_month,
        'deadline_year' => $deadline_year,
        'tags' => $task->tags,
        'top_priority' => $task->top_priority,
    ];

}

unset($_SESSION['tasks/view/messages']);

$base = '../../';

include_once 'fns/create_content.php';
include_once '../../fns/compressed_js_script.php';
$content =
    create_content($id, $values)
    .compressed_js_script('formCheckbox', $base);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Task #$id", $content, $base);
