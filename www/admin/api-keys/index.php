<?php

include_once '../fns/require_admin.php';
$admin_user = require_admin();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminApiKeys/OrderBy/get.php";
$order_by = AdminApiKeys\OrderBy\get();

include_once "$fnsDir/AdminApiKeys/indexPage.php";
include_once '../../lib/mysqli.php';
$apiKeys = AdminApiKeys\indexPage($mysqli, $offset, $limit, $total, $order_by);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

include_once '../../fns/compressed_js_script.php';
$scripts = compressed_js_script('dateAgo', $base);

$items = [];
if ($apiKeys) {

    if ($total > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $content = SearchForm\emptyContent('Search admin API keys...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $content);

        $scripts .= compressed_js_script('searchForm', $base);

    }

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once 'fns/render_admin_api_keys.php';
    render_admin_api_keys($apiKeys, $items);

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No admin API keys');
}

include_once 'fns/sort_panel.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content =
    Page\create(
        [
            'title' => 'Administration',
            'href' => '../#api-keys',
        ],
        'Admin API Keys',
        Page\sessionErrors('admin/api-keys/errors')
        .Page\sessionMessages('admin/api-keys/messages')
        .join('<div class="hr"></div>', $items),
        create_new_item_button('Admin API Key', '', !$total)
    )
    .sort_panel($order_by, $total);

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Admin API Keys',
    $content, '../', ['scripts' => $scripts]);
