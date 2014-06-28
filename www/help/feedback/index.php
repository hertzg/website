<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'help/feedback/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['text' => ''];

unset($_SESSION['help/messages']);

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/notes.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Help',
            'href' => '..',
        ],
    ],
    'Feedback',
    Page\sessionErrors('help/feedback/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .Form\notes(['Minimum 6 words.'])
        .'<div class="hr"></div>'
        .Form\button('Submit Feedback')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Leave Feedback', $content, $base);
