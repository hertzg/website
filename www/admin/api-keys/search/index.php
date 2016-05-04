<?php

include_once '../../../../lib/defaults.php';

// TODO do not load this page if no admin api keys are present

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
request_valid_keyword_tag_offset($keyword, $tag, $offset, $includes, $excludes);

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminApiKeys/OrderBy/get.php";
$order_by = AdminApiKeys\OrderBy\get();

include_once "$fnsDir/AdminApiKeys/searchPage.php";
include_once '../../../lib/mysqli.php';
$apiKeys = AdminApiKeys\searchPage($mysqli, $includes,
    $excludes, $offset, $limit, $total, $order_by);

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
    render_admin_api_keys($includes, $apiKeys, $items);

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No admin API keys found');
}

include_once '../fns/sort_panel.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../../#api-keys',
    ],
    'Admin API Keys',
    Page\sessionErrors('admin/api-keys/errors')
    .Page\sessionMessages('admin/api-keys/messages')
    .join('<div class="hr"></div>', $items)
    .sort_panel($order_by, $total, '../'),
    create_new_item_button('Admin API Key', '../')
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Admin API Keys', $content, '../../', [
    'scripts' => compressed_js_script('searchForm', $base),
]);
