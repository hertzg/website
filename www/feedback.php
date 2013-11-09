<?php

include_once 'lib/require-user.php';
include_once 'fns/ifset.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

$lastpost = ifset($_SESSION['feedback_lastpost']);

unset($_SESSION['home_messages']);

$page->title = 'Leave Feedback';
$page->finish(
    Tab::create(
        Tab::item('Home', 'home.php')
        .Tab::activeItem('Feedback')
    )
    .Page::errors(ifset($_SESSION['feedback_errors']))
    .Form::create(
        'submit-feedback.php',
        Form::textarea('feedbacktext', 'Feedback text', array(
            'value' => ifset($lastpost['feedbacktext']),
            'autofocus' => true,
            'required' => true,
        ))
        .Form::notes(array('Minimum 6 words.'))
        .Page::HR
        .Form::button('Submit Feedback')
    )
);
