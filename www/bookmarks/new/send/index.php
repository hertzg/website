<?php

include_once 'fns/require_stage.php';
list($user) = require_stage();

$key = 'bookmarks/new/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../../fns/ItemList/escapedPageQuery.php';
include_once '../../../fns/ItemList/listHref.php';
include_once '../../../fns/ItemList/pageParams.php';
include_once '../../../fns/Page/itemSendForm.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/warnings.php';
include_once '../../../lib/mysqli.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../'.ItemList\listHref(),
        ],
        [
            'title' => 'New',
            'href' => '../'.ItemList\escapedPageQuery(),
        ],
    ],
    'Send',
    Page\sessionErrors('bookmarks/new/send/errors')
    .Page\warnings(['Send the new bookmark to:'])
    .Page\itemSendForm($mysqli, $user->id_users,
        $values['username'], ItemList\pageParams())
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Send New Bookmark', $content, '../../../');
