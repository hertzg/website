<?php

include_once '../../../../../lib/defaults.php';

include_once '../../fns/require_connection.php';
include_once '../../../../lib/mysqli.php';
list($connection, $id, $admin_user) = require_connection($mysqli, '../../');

include_once '../fns/unset_session_vars.php';
unset_session_vars();

$base = '../../../../';
$fnsDir = '../../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
request_valid_keyword_tag_offset($keyword, $tag,
    $offset, $includes, $excludes, ['id' => $id]);

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminConnectionAuths/searchPageOnAdminConnection.php";
$auths = \AdminConnectionAuths\searchPageOnAdminConnection(
    $mysqli, $id, $includes, $excludes, $offset, $limit, $total);

$params = [
    'id' => $id,
    'keyword' => $keyword,
];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once "$fnsDir/SearchForm/content.php";
$content = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .SearchForm\content($keyword, 'Search authentications...', "../?id=$id");

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $content)];

if ($total) {

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once "$fnsDir/keyword_regex.php";
    $regex = keyword_regex($includes);

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($auths as $auth) {
        $address = htmlspecialchars($auth->remote_address);
        $text =
            preg_replace($regex, '<mark>$0</mark>', $address)
            .' '.preg_replace($regex, '<mark>$0</mark>', $auth->method)
            .'<div class="imageText-description">'
                .export_date_ago($auth->insert_time, true)
            .'</div>';
        $items[] = create_image_text($text, 'sign-in');
    }

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No authentications found');
}

include_once "$fnsDir/auth_expire_days.php";
$auth_expire_days = auth_expire_days();

if ($offset + $limit >= $total &&
    $connection->insert_time < time() - $auth_expire_days * 24 * 60 * 60) {

    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Older data not available');

}

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => "Connection #$id",
        'href' => "../../view/?id=$id#all-auths",
    ],
    'Authentication History',
    join('<div class="hr"></div>', $items)
    .Page\infoText(
        "Authentications older than $auth_expire_days"
        .' days are automatically deleted.'
    )
);

$title = "Connection #$id Authentication History";

include_once '../../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, $title, $content, '../../../', [
    'scripts' => compressed_js_script('dateAgo', $base)
        .compressed_js_script('searchForm', $base),
]);
