<?php

include_once '../fns/require_admin.php';
$admin_user = require_admin();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

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

$scripts = '';
$items = [];

if ($connections) {

    if ($total > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $content = SearchForm\emptyContent('Search connections...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $content);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts .= compressed_js_script('searchForm', '../../');

    }

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($connections as $connection) {
        $id = $connection->id;
        $title = htmlspecialchars($connection->address);
        $href = 'view/'.ItemList\escapedItemQuery($id);
        $items[] = Page\imageArrowLink($title,
            $href, 'connection', ['id' => $id]);
    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No connections');
}

include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../#connections',
    ],
    'Connections',
    Page\sessionErrors('admin/connections/errors')
    .Page\sessionMessages('admin/connections/messages')
    .join('<div class="hr"></div>', $items),
    create_new_item_button('Connection', '', !$total)
);

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Connections', $content, '../', ['scripts' => $scripts]);
