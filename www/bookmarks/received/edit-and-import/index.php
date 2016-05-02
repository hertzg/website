<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli, '../');

unset($_SESSION['bookmarks/received/view/messages']);

$key = 'bookmarks/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'url',
        'url' => $receivedBookmark->url,
        'title' => $receivedBookmark->title,
        'tags' => $receivedBookmark->tags,
    ];
}

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Received Bookmark #$id",
        'href' => "../view/$escapedItemQuery#edit-and-import",
    ],
    'Edit and Import',
    Page\sessionErrors('bookmarks/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .Form\button('Import Bookmark')
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit and Import Received Bookmark #$id",
    $content, '../../../');
