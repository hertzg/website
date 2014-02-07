<?php

include_once 'lib/require-user.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

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

$page->base = '../';
$page->title = 'Leave Feedback';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '..')
        .Tab::item('Help', './')
        .Tab::activeItem('Feedback'),
        $pageErrors
        .Form::create(
            'submit-feedback.php',
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
