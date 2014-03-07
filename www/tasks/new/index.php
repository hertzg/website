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

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('tasks/new/index_errors');

unset($_SESSION['tasks/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';

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
        .'<form action="submit.php" method="post">'
            .Form::textarea('tasktext', 'Text', array(
                'value' => $values['tasktext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .'<div class="hr"></div>'
            .Form\button('Save')
        .'</form>'
    )
);
