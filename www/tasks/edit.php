<?php

include_once 'lib/require-task.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['tasks/edit_lastpost']);

unset($_SESSION['tasks/index_messages']);

$page->base = '../';
$page->title = 'Edit Task';
$page->finish(
    Tab::create(
        Tab::item('Tasks', 'index.php')
        .Tab::item('View', "view.php?id=$id")
        .Tab::activeItem('Edit')
    )
    .Page::errors(ifset($_SESSION['tasks/edit_errors']))
    .Form::create(
        'submit-edit.php',
        Form::textarea('tasktext', 'Text', array(
            'value' => ifset($lastpost['tasktext'], $task->tasktext),
            'autofocus' => true,
            'required' => true,
        ))
        .Page::HR
        .Form::textfield('tags', 'Tags', array(
            'value' => ifset($lastpost['tags'], $task->tags),
        ))
        .Page::HR
        .Form::button('Save Changes')
        .Form::hidden('id', $id)
    )
);
