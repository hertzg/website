<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

if (array_key_exists('tasks/edit/values', $_SESSION)) {
    $values = $_SESSION['tasks/edit/values'];
} else {
    $values = (array)$task;
}

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => "Task #$id",
                'href' => "../view/?id=$id",
            ),
        ),
        'Edit',
        Page\sessionErrors('tasks/edit/errors')
        .'<form action="submit.php" method="post">'
            .Form\textarea('tasktext', 'Text', array(
                'value' => $values['tasktext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('id', $id)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Task #$id", $content, '../../');
