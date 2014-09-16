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
    $_SESSION['home/messages'],
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/new/send/errors'],
    $_SESSION['notes/new/send/messages'],
    $_SESSION['notes/new/send/values']
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
            'title' => 'Notes',
            'href' => ItemList\listHref(),
        ],
    ],
    'New',
    Page\sessionErrors('notes/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($base, $values)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Note', $content, $base);
