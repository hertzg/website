<?php

include_once 'lib/require-user.php';
include_once '../../classes/Form.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

if (array_key_exists('tasks/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['tasks/new/index_lastpost'];
} else {
    $values = array(
        'tasktext' => '',
        'tags' => '',
    );
}

if (array_key_exists('tasks/new/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['tasks/new/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['tasks/index_messages']);

$page->base = '../../';
$page->title = 'New Task';
$page->finish(
    Tab::create(
        Tab::item('Tasks', '../')
        .Tab::activeItem('New'),
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
            .Form::button('Save')
        )
    )
);
