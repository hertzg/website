<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/BookmarkRevisions/indexOnBookmark.php";
include_once '../../lib/mysqli.php';
$revisions = BookmarkRevisions\indexOnBookmark($mysqli, $id);

$items = [];
include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($revisions as $revision) {
    $items[] = Page\imageArrowLinkWithDescription(
        export_date_ago($revision->insert_time),
        'R'.($revision->revision + 1), '', 'restore-defaults');
}

include_once "$fnsDir/Page/create.php";
$content = \Page\create(
    [
        'title' => "Bookmark #$id",
        'href' => "../view/?id=$id#history",
    ],
    'History',
    join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Bookmark #$id History", $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
