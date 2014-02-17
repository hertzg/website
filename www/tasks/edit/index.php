<?php

include_once 'lib/require-task.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('tasks/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['tasks/edit_lastpost'];
} else {
    $values = (array)$task;
}

if (array_key_exists('tasks/edit_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['tasks/edit_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['tasks/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Task #$id";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => "Task #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textarea('tasktext', 'Text', array(
                'value' => $values['tasktext'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .Page::HR
            .Form::button('Save Changes')
            .Form::hidden('id', $id)
        )
    )
);
