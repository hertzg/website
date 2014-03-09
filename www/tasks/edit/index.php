<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

if (array_key_exists('tasks/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['tasks/edit_lastpost'];
} else {
    $values = (array)$task;
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('tasks/edit_errors');

unset($_SESSION['tasks/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
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
        $pageErrors
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
