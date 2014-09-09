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
    $_SESSION['bookmarks/new/send/messages'],
    $_SESSION['bookmarks/new/send/values'],
    $_SESSION['home/messages']
);

include_once '../fns/create_form_items.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/ItemList/pageHiddenInputs.php';
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
            'title' => 'Bookmarks',
            'href' => ItemList\listHref(),
        ],
    ],
    'New',
    Page\sessionErrors('bookmarks/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Bookmark', $content, $base);
