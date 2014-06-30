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

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/datefield.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textarea.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
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
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\datefield([
            'name' => 'deadline_day',
            'value' => $values['deadline_day'],
        ], [
            'name' => 'deadline_month',
            'value' => $values['deadline_month'],
        ], [
            'name' => 'deadline_year',
            'value' => $values['deadline_year'],
            'min' => date('Y'),
            'max' => date('Y') + 2,
        ], 'Deadline', false, true)
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'top_priority',
            'Mark as Top Priority', $values['top_priority'])
        .'<div class="hr"></div>'
        .Form\button('Import Task')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Received Task #$id", $content, $base);
