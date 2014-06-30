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

unset(
    $_SESSION['tasks/edit/send/errors'],
    $_SESSION['tasks/edit/send/values'],
    $_SESSION['tasks/view/messages']
);

include_once '../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

$base = '../../';

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/checkbox.php';
include_once '../../fns/Form/datefield.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => ItemList\listHref(),
        ],
        [
            'title' => "Task #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Edit',
    Page\sessionErrors('tasks/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
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
        .Page\staticTwoColumns(
            Form\button('Save Changes'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Task #$id", $content, $base);
