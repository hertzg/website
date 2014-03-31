<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'notes/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => '',
        'tags' => '',
    ];
}

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages']
);

include_once '../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

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
                'title' => 'Notes',
                'href' => '..',
            ],
        ],
        'New',
        Page\sessionErrors('notes/new/errors')
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
            .Form\button('Save Note')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Note', $content, $base);
