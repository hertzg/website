<?php

include_once 'lib/require-user.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('help/feedback_lastpost', $_SESSION)) {
    $values = $_SESSION['help/feedback_lastpost'];
} else {
    $values = array('feedbacktext' => '');
}

if (array_key_exists('help/feedback_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['help/feedback_errors']);
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
