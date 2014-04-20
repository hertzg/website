<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

$key = 'tasks/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$task;

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

$base = '../../';

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/checkbox.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
$content = create_tabs(
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
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'top_priority',
            'Mark as Top Priority', $values['top_priority'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Task #$id", $content, $base);
