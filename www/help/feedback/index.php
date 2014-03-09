<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

if (array_key_exists('help/feedback/index_lastpost', $_SESSION)) {
    $values = $_SESSION['help/feedback/index_lastpost'];
} else {
    $values = array('feedbacktext' => '');
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('help/feedback/index_errors');

unset($_SESSION['help/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/notes.php';
include_once '../../fns/Form/textarea.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Help',
                'href' => '..',
            ),
        ),
        'Feedback',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textarea('feedbacktext', 'Feedback text', array(
                'value' => $values['feedbacktext'],
                'autofocus' => true,
                'required' => true,
            ))
            .Form\notes(array('Minimum 6 words.'))
            .'<div class="hr"></div>'
            .Form\button('Submit Feedback')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Leave Feedback', $content, '../../');
