<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
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
    include_once '../../fns/Page/errors.php';
    $pageErrors = Page\errors($_SESSION['tasks/new/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['tasks/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'New Task';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Tasks',
                'href' => '..',
            ),
        ),
        'New',
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
