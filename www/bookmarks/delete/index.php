<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/Page/imageLink.php';

$href = "submit.php$escapedItemQuery";
$yesLink = Page\imageLink('Yes, delete bookmark', $href, 'yes');

$noLink = Page\imageLink('No, return back', "../view/$escapedItemQuery", 'no');

include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
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
    "Bookmark #$id",
    Page\text('Are you sure you want to delete the bookmark?'
        .' It will be moved to Trash.')
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Bookmark #$id?", $content, '../../');
