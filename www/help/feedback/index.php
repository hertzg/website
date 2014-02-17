<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('help/feedback/index_lastpost', $_SESSION)) {
    $values = $_SESSION['help/feedback/index_lastpost'];
} else {
    $values = array('feedbacktext' => '');
}

if (array_key_exists('help/feedback/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['help/feedback/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['help/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'Leave Feedback';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Help',
                'href' => '..',
            ],
        ],
        'Feedback',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textarea('feedbacktext', 'Feedback text', array(
                'value' => $values['feedbacktext'],
                'autofocus' => true,
                'required' => true,
            ))
            .Form::notes(array('Minimum 6 words.'))
            .Page::HR
            .Form::button('Submit Feedback')
        )
    )
);
