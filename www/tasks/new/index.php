<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'tasks/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'task_text' => '',
        'tags' => '',
    ];
}

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
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
            .Form\textarea('task_text', 'Text', [
                'value' => $values['task_text'],
                'maxlength' => $maxLengths['task_text'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', [
                'value' => $values['tags'],
                'maxlength' => $maxLengths['tags'],
            ])
            .'<div class="hr"></div>'
            .Form\button('Save Task')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Task', $content, $base);
