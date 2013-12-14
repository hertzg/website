<?php

include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['tasks/add_lastpost']);

unset($_SESSION['tasks/index_messages']);

$page->base = '../';
$page->title = 'New Task';
$page->finish(
    Tab::create(
        Tab::item('Tasks', 'index.php')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['tasks/add_errors']))
        .Form::create(
            'submit-add.php',
            Form::textarea('tasktext', 'Text', array(
                'value' => ifset($lastpost['tasktext']),
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('tags', 'Tags', array(
                'value' => ifset($lastpost['tags']),
            ))
            .Page::HR
            .Form::button('Save')
        )
    )
);
