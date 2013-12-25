<?php

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

if (array_key_exists('tasks/add_lastpost', $_SESSION)) {
    $values = $_SESSION['tasks/add_lastpost'];
} else {
    $values = array(
        'tasktext' => '',
        'tags' => '',
    );
}

unset($_SESSION['tasks/index_messages']);

$page->base = '../';
$page->title = 'New Task';
$page->finish(
    Tab::create(
        Tab::item('Tasks', './')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['tasks/add_errors']))
        .Form::create(
            'submit-add.php',
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
            .Form::button('Save')
        )
    )
);
