<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

$id = abs((int)$id);

include_once "$fnsDir/BookmarkRevisions/getNotDeletedOnUser.php";
include_once '../../../lib/mysqli.php';
$revision = BookmarkRevisions\getNotDeletedOnUser(
    $mysqli, $user->id_users, $id);

if (!$revision) {
    include_once "$fnsDir/redirect.php";
    redirect('../..');
}

$id_bookmarks = $revision->id_bookmarks;

$items = [];

include_once "$fnsDir/Page/text.php";

$title = $revision->title;
if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));

$items[] = \Page\text(htmlspecialchars($revision->url));

$tags = $revision->tags;
if ($tags !== '') $items[] = \Page\text("Tags: $tags");

$title = "Bookmark #{$id_bookmarks} R".($revision->revision + 1);

include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => 'History',
        'href' => "../?id=$id_bookmarks#$id",
    ],
    $title,
    join('<div class="hr"></div>', $items)
    .Page\infoText('Revision made '.export_date_ago($revision->insert_time).'.')
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
