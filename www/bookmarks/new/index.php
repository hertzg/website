<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'bookmarks/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'url' => '',
        'title' => '',
        'tags' => '',
    ];
}

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/new/send/errors'],
    $_SESSION['bookmarks/new/send/values']
);

include_once '../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Bookmarks',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('bookmarks/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('url', 'URL', [
            'value' => $values['url'],
            'maxlength' => $maxLengths['url'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('title', 'Title', [
            'value' => $values['title'],
            'maxlength' => $maxLengths['title'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Page\twoColumns(
            Form\button('Save Bookmark'),
            Form\button('Send Bookmark', 'sendButton')
        )
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Bookmark', $content, $base);
