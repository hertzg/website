<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

$key = 'bookmarks/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/itemSendForm.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/warnings.php';
include_once '../../fns/Username/maxLength.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => ItemList\listHref(),
        ],
        [
            'title' => "Bookmark #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Send',
    Page\sessionErrors('bookmarks/send/errors')
    .Page\warnings(['Send the bookmark to:'])
    .Page\itemSendForm($mysqli, $user->id_users,
        $values['username'], $id, ItemList\itemHiddenInputs($id))
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send Bookmark #$id", $content, '../../');
