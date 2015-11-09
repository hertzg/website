<?php

include_once '../fns/require_admin.php';
require_admin();

unset($_SESSION['admin/messages']);

$fnsDir = '../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/InvalidSignins/indexPage.php";
include_once '../../lib/mysqli.php';
$invalidSignins = InvalidSignins\indexPage($mysqli, $offset, $limit, $total);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

$items = [];

if ($invalidSignins) {

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($invalidSignins as $invalidSignin) {
        $text =
            htmlspecialchars($invalidSignin->username).'<br />'
            .'From '.htmlspecialchars($invalidSignin->remote_address)
            .'<div class="imageText-description">'
                .export_date_ago($invalidSignin->insert_time, true)
            .'</div>';
        $items[] = create_image_text($text, 'invalid-sign-in');
    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

} else {
    $scripts = '';
}

if ($offset + $limit >= $total) {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Older data not available');
}

include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#invalid-signins',
        ],
    ],
    'Invalid Signins',
    join('<div class="hr"></div>', $items)
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Invalid Signins', $content, '../', ['scripts' => $scripts]);
