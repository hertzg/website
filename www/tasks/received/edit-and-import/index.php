<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

unset($_SESSION['tasks/received/view/messages']);

$key = 'tasks/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    $deadline_time = $receivedTask->deadline_time;
    if ($deadline_time === null) {
        $deadline_day = $deadline_month = $deadline_year = 0;
    } else {
        $deadline_day = date('d', $deadline_time);
        $deadline_month = date('n', $deadline_time);
        $deadline_year = date('Y', $deadline_time);
    }

    $values = [
        'text' => $receivedTask->text,
        'deadline_day' => $deadline_day,
        'deadline_month' => $deadline_month,
        'deadline_year' => $deadline_year,
        'tags' => $receivedTask->tags,
        'top_priority' => $receivedTask->top_priority,
    ];

}

include_once '../../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

$base = '../../../';

include_once '../../fns/create_form_items.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Received Task #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit and Import',
    Page\sessionErrors('tasks/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($base, $values)
        .'<div class="hr"></div>'
        .Form\button('Import Task')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Received Task #$id", $content, $base);
