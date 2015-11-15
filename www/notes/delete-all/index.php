<?php

include_once '../fns/require_notes.php';
$user = require_notes();

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages']
);

include_once '../../lib/mysqli.php';

include_once "$fnsDir/ItemList/pageParams.php";
$pageParams = ItemList\pageParams();

if (array_key_exists('keyword', $pageParams)) {
    include_once '../fns/SearchPage/create.php';
    $content = SearchPage\create($mysqli, $user, $scripts);
} else {
    include_once '../fns/create_page.php';
    $content = create_page($mysqli, $user, $scripts, '../');
}

include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog(
    'Are you sure you want to delete all the notes?'
    .' They will be moved to Trash.', 'Yes, delete all notes',
    'submit.php', ItemList\listHref());

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete All Notes?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
