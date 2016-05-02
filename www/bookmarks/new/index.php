<?php

include_once '../../../lib/defaults.php';

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'bookmarks/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/Bookmarks/request.php';
    list($url, $title, $tags) = Bookmarks\request();

    $values = [
        'focus' => 'url',
        'url' => $url,
        'title' => $title,
        'tags' => $tags,
    ];

}

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/view/messages'],
    $_SESSION['home/messages']
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
        'title' => 'Bookmarks',
        'href' => ItemList\listHref(),
    ],
    'New Bookmark',
    Page\sessionErrors('bookmarks/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, 'New Bookmark', $content, $base);
