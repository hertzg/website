<?php

include_once '../fns/require_admin.php';
require_admin();

unset(
    $_SESSION['admin/messages'],
    $_SESSION['admin/api-keys/new/errors'],
    $_SESSION['admin/api-keys/new/values'],
    $_SESSION['admin/api-keys/view/messages']
);

$fnsDir = '../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminApiKeys/indexPage.php";
include_once '../../lib/mysqli.php';
$apiKeys = AdminApiKeys\indexPage($mysqli, $offset, $limit, $total);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

$items = [];

if ($apiKeys) {

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($apiKeys as $apiKey) {
        $id = $apiKey->id;
        $items[] = Page\imageArrowLink(htmlspecialchars($apiKey->name),
            'view/'.ItemList\escapedItemQuery($id), 'api-key', ['id' => $id]);
    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No admin API keys');
}

include_once "$fnsDir/ItemList/escapedPageQuery.php";
include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#api-keys',
        ],
    ],
    'Admin API Keys',
    Page\sessionErrors('admin/api-keys/errors')
    .Page\sessionMessages('admin/api-keys/messages')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/'.ItemList\escapedPageQuery(), 'Admin API Key')
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Admin API Keys', $content, '../');
