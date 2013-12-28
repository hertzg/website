<?php

include_once 'lib/require-user.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

if (array_key_exists('feedback_lastpost', $_SESSION)) {
    $values = $_SESSION['feedback_lastpost'];
} else {
    $values = array('feedbacktext' => '');
}

if (array_key_exists('feedback_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['feedback_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['home_messages']);

$page->title = 'Leave Feedback';
$page->finish(
    Tab::create(
        Tab::activeItem('Feedback'),
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
