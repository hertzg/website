<?php

include_once '../../fns/require_admin.php';
require_admin();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminApiKeys/OrderBy/get.php";
$order_by = AdminApiKeys\OrderBy\get();

include_once "$fnsDir/AdminApiKeys/searchPage.php";
include_once '../../../lib/mysqli.php';
$apiKeys = AdminApiKeys\searchPage($mysqli,
    $keyword, $offset, $limit, $total, $order_by);

$params = ['keyword' => $keyword];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once '../../../fns/compressed_js_script.php';
$scripts = compressed_js_script('dateAgo', $base);

include_once "$fnsDir/SearchForm/content.php";
$content = SearchForm\content($keyword, 'Search admin API keys...', '../');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $content)];

if ($apiKeys) {

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once 'fns/render_admin_api_keys.php';
    render_admin_api_keys($keyword, $apiKeys, $items);

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No admin API keys found');
}

include_once '../fns/sort_panel.php';
include_once "$fnsDir/ItemList/escapedPageQuery.php";
include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../../#api-keys',
        ],
    ],
    'Admin API Keys',
    Page\sessionErrors('admin/api-keys/errors')
    .Page\sessionMessages('admin/api-keys/messages')
    .join('<div class="hr"></div>', $items)
    .sort_panel($order_by, $total, '../'),
    Page\newItemButton('../new/'.ItemList\escapedPageQuery(), 'Admin API Key')
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page('Admin API Keys', $content, '../../', [
    'scripts' => compressed_js_script('searchForm', $base),
]);