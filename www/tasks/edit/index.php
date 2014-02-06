<?php

include_once 'lib/require-task.php';
include_once '../../classes/Form.php';
include_once '../../classes/Tab.php';
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

$page->base = '../../';
$page->title = 'Edit Task';
$page->finish(
    Tab::create(
        Tab::item('Tasks', '../')
        .Tab::item("Task #$id", "../view/?id=$id")
        .Tab::activeItem('Edit'),
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
