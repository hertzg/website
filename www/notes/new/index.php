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
        'encrypt' => false,
    ];
}

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/new/send/errors'],
    $_SESSION['notes/new/send/values']
);

include_once '../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

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
        .Form\checkbox($base, 'encrypt', 'Encrypt in Listings', $values['encrypt'])
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Note', $content, $base);
