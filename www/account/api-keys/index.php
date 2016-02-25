<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/ApiKeys/indexPageOnUser.php";
include_once '../../lib/mysqli.php';
$apiKeys = ApiKeys\indexPageOnUser($mysqli,
    $user->id_users, $offset, $limit, $total, $user->api_keys_order_by);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

include_once "$fnsDir/compressed_js_script.php";
$scripts = compressed_js_script('dateAgo', $base);

$items = [];
if ($apiKeys) {

    if ($total > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $content = SearchForm\emptyContent('Search API keys...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $content);

        $scripts .= compressed_js_script('searchForm', $base);

    }

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once 'fns/render_api_keys.php';
    render_api_keys($user, $apiKeys, $items);

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No API keys');
}

include_once 'fns/sort_panel.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content =
    Page\create(
        [
            'title' => 'Account',
            'href' => '../#api-keys',
        ],
        'API Keys',
        Page\sessionErrors('account/api-keys/errors')
        .Page\sessionMessages('account/api-keys/messages')
        .join('<div class="hr"></div>', $items),
        create_new_item_button('API Key', '', !$user->num_api_keys)
    )
    .sort_panel($user, $total);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'API Keys', $content, $base, ['scripts' => $scripts]);
