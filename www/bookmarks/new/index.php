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
    $_SESSION['bookmarks/messages']
);

include_once '../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
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
            .Form\button('Save Bookmark')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Bookmark', $content, $base);
