<?php

include_once '../fns/require_places.php';
$user = require_places();

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['places/errors'],
    $_SESSION['places/messages']
);

include_once '../../lib/mysqli.php';

include_once "$fnsDir/ItemList/pageParams.php";
$pageParams = ItemList\pageParams();

if (array_key_exists('keyword', $pageParams)) {
    include_once '../fns/SearchPage/create.php';
    $content = SearchPage\create($mysqli, $user);
} else {
    include_once '../fns/create_page.php';
    $content = create_page($mysqli, $user, '../');
}

include_once "$fnsDir/ItemList/escapedPageQuery.php";
$yesHref = 'submit.php'.ItemList\escapedPageQuery();

include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog(
    'Are you sure you want to delete all the places?'
    .' They will be moved to Trash.', 'Yes, delete all places',
    $yesHref, ItemList\listHref());

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete All Places?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);