<?php

include_once 'lib/require-task.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

if (array_key_exists('tasks/edit_lastpost', $_SESSION)) {
    $values = (object)$_SESSION['tasks/edit_lastpost'];
} else {
    $values = $task;
}

unset($_SESSION['tasks/index_messages']);

$page->base = '../';
$page->title = 'Edit Task';
$page->finish(
    Tab::create(
        Tab::item('Tasks', './')
        .Tab::item('View', "view.php?id=$id")
        .Tab::activeItem('Edit'),
        Page::errors(ifset($_SESSION['tasks/edit_errors']))
        .Form::create(
            'submit-edit.php',
            Form::textarea('tasktext', 'Text', array(
                'value' => $values->tasktext,
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('tags', 'Tags', array(
                'value' => $values->tags,
            ))
            .Page::HR
            .Form::button('Save Changes')
            .Form::hidden('id', $id)
        )
    )
);
