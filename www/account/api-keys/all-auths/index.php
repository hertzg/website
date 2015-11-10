<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/ApiKeyAuths/indexPageOnApiKey.php";
$auths = \ApiKeyAuths\indexPageOnApiKey($mysqli, $id, $offset, $limit, $total);

if (!$total) {
    include_once "$fnsDir/redirect.php";
    redirect("../view/?id=$id");
}

$items = [];
$params = ['id' => $id];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once "$fnsDir/compressed_js_script.php";
$scripts = compressed_js_script('dateAgo', $base);

if ($total > 1) {

    include_once "$fnsDir/SearchForm/emptyContent.php";
    $content = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
        .SearchForm\emptyContent('Search authentications...');

    include_once "$fnsDir/SearchForm/create.php";
    $items[] = SearchForm\create('search/', $content);

    $scripts .= compressed_js_script('searchForm', $base);

}

include_once 'fns/render_prev_button.php';
render_prev_button($offset, $limit, $total, $items, $params);

include_once "$fnsDir/create_image_text.php";
include_once "$fnsDir/export_date_ago.php";
foreach ($auths as $auth) {
    $text =
        htmlspecialchars($auth->remote_address)
        .'<div class="imageText-description">'
            .export_date_ago($auth->insert_time, true)
        .'</div>';
    $items[] = create_image_text($text, 'sign-in');
}

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $params);

if ($offset + $limit >= $total) {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Older data not available');
}

include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "API Key #$id",
            'href' => "../view/?id=$id#all-auths",
        ],
    ],
    'Authentication History',
    join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "API Key #$id Authentication History",
    $content, $base, ['scripts' => $scripts]);
