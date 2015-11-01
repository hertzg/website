<?php

include_once '../fns/require_admin.php';
require_admin();

unset(
    $_SESSION['admin/messages'],
    $_SESSION['admin/connections/new/errors'],
    $_SESSION['admin/connections/new/values'],
    $_SESSION['admin/connections/view/messages']
);

$fnsDir = '../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminConnections/indexPage.php";
include_once '../../lib/mysqli.php';
$connections = AdminConnections\indexPage($mysqli, $offset, $limit, $total);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

$items = [];

if ($connections) {

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($connections as $connection) {
        $id = $connection->id;
        $items[] = Page\imageArrowLink(htmlspecialchars($connection->address),
            'view/'.ItemList\escapedItemQuery($id), 'connection', ['id' => $id]);
    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No connections');
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
            'href' => '../#connections',
        ],
    ],
    'Connections',
    Page\sessionErrors('admin/connections/errors')
    .Page\sessionMessages('admin/connections/messages')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/'.ItemList\escapedPageQuery(), 'Connection')
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Connections', $content, '../');
