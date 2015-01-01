<?php

$fnsDir = '../../../fns';

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli, '../');

unset($_SESSION['bookmarks/received/view/messages']);

$key = 'bookmarks/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedBookmark;

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Received Bookmark #$id",
            'href' => '../view/'.ItemList\Received\escapedItemQuery($id).'#edit-and-import',
        ],
    ],
    'Edit and Import',
    Page\sessionErrors('bookmarks/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Import Bookmark')
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
$title = "Edit and Import Received Bookmark #$id";
echo_page($user, $title, $content, '../../../');
