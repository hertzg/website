<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$key = 'bookmarks/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'url',
        'url' => $bookmark->url,
        'title' => $bookmark->title,
        'tags' => $bookmark->tags,
    ];
}

unset($_SESSION['bookmarks/view/messages']);

include_once '../fns/create_form_items.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
$content = Page\create(
    [
        'title' => "Bookmark #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('bookmarks/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save Changes'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, "Edit Bookmark #$id", $content, '../../');
