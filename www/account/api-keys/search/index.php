<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

if (!$user->num_api_keys) {
    unset(
        $_SESSION['account/api-keys/errors'],
        $_SESSION['account/api-keys/messages']
    );
    include_once "$fnsDir/redirect.php";
    redirect('..');
}

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/ApiKeys/searchPageOnUser.php";
include_once '../../../lib/mysqli.php';
$apiKeys = ApiKeys\searchPageOnUser($mysqli, $user->id_users,
    $keyword, $offset, $limit, $total, $user->api_keys_order_by);

$params = ['keyword' => $keyword];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once "$fnsDir/SearchForm/content.php";
$content = SearchForm\content($keyword, 'Search API keys...', '../');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $content)];

if ($apiKeys) {

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once 'fns/render_api_keys.php';
    render_api_keys($user, $keyword, $apiKeys, $items);

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No API keys found');
}

include_once '../fns/sort_panel.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Account',
                'href' => '../../#api-keys',
            ],
        ],
        'API Keys',
        Page\sessionErrors('account/api-keys/errors')
        .Page\sessionMessages('account/api-keys/messages')
        .join('<div class="hr"></div>', $items),
        create_new_item_button('API Key', '../')
    )
    .sort_panel($user, $total, '../');

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'API Keys', $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base)
        .compressed_js_script('searchForm', $base),
]);
