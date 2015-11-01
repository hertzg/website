<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id) = require_connection($mysqli);

unset($_SESSION['admin/connections/view/messages']);

$fnsDir = '../../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminConnectionAuths/indexPageOnAdminConnection.php";
$auths = \AdminConnectionAuths\indexPageOnAdminConnection(
    $mysqli, $id, $offset, $limit, $total);

if (!$total) {
    include_once "$fnsDir/redirect.php";
    redirect("../view/?id=$id");
}

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, ['id' => $id]);

$items = [];
$params = ['id' => $id];

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
            'title' => "Connection #$id",
            'href' => "../view/?id=$id#all-auths",
        ],
    ],
    'Authentication History',
    join('<div class="hr"></div>', $items)
);

$title = "Connection #$id Authentication History";

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($title, $content, '../../', [
    'scripts' => compressed_js_script('dateAgo', '../../../'),
]);
