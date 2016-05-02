<?php

include_once '../../../lib/defaults.php';

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'notes/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/Notes/request.php';
    list($text, $tags, $encrypt_in_listings,
        $password_protect) = Notes\request();

    $values = [
        'focus' => 'text',
        'text' => $text,
        'tags' => $tags,
        'encrypt_in_listings' => $encrypt_in_listings,
        'password_protect' => $password_protect,
    ];

}

unset(
    $_SESSION['home/messages'],
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/view/messages']
);

include_once '../fns/create_form_items.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/ItemList/pageHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
$content = Page\create(
    [
        'title' => 'Notes',
        'href' => ItemList\listHref(),
    ],
    'New Note',
    Page\sessionErrors('notes/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts)
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, 'New Note', $content, $base, ['scripts' => $scripts]);
