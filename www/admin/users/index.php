<?php

include_once '../fns/require_admin.php';
require_admin();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$fnsDir = '../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/Users/OrderBy/get.php";
$order_by = Users\OrderBy\get();

include_once "$fnsDir/Users/indexPage.php";
include_once '../../lib/mysqli.php';
$users = Users\indexPage($mysqli, $offset, $limit, $total, $order_by);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

$items = [];
$scripts = '';

if ($users) {

    if ($total > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $formContent = SearchForm\emptyContent('Search users...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $formContent);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('searchForm', '../../');

    }

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($users as $user) {
        $id = $user->id_users;
        $items[] = Page\imageArrowLink(htmlspecialchars($user->username),
            'view/'.ItemList\escapedItemQuery($id), 'user', ['id' => $id]);
    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No users');
}

// TODO make new item button green
include_once 'fns/sort_panel.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#users',
        ],
    ],
    'Users',
    Page\sessionErrors('admin/users/errors')
    .Page\sessionMessages('admin/users/messages')
    .join('<div class="hr"></div>', $items)
    .sort_panel($order_by, $total),
    create_new_item_button('User')
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Users', $content, '../', ['scripts' => $scripts]);
