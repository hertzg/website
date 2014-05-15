<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'tasks/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => '',
        'top_priority' => false,
        'tags' => '',
    ];
}

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages'],
    $_SESSION['tasks/new/send/errors'],
    $_SESSION['tasks/new/send/values']
);

include_once '../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/checkbox.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Tasks',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('tasks/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'top_priority',
            'Mark as Top Priority', $values['top_priority'])
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Task', $content, $base);
