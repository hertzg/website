<?php

include_once '../fns/require_admin.php';
require_admin();

unset($_SESSION['admin/messages']);

$fnsDir = '../../fns';

include_once "$fnsDir/InvalidSignins/index.php";
include_once '../../lib/mysqli.php';
$invalidSignins = InvalidSignins\index($mysqli);

$items = [];

if ($invalidSignins) {

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($invalidSignins as $invalidSignin) {
        $text =
            htmlspecialchars($invalidSignin->username).'<br />'
            .'From '.htmlspecialchars($invalidSignin->remote_address)
            .'<div style="color: #777; font-size: 12px; line-height: 14px">'
                .export_date_ago($invalidSignin->insert_time, true)
            .'</div>';
        $items[] = create_image_text($text, 'generic');
    }

} else {
    $scripts = '';
}

include_once "$fnsDir/Page/info.php";
$items[] = Page\info('Older data not available');

include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '..#invalid-signins',
        ],
    ],
    'Invalid Signins',
    join('<div class="hr"></div>', $items)
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Invalid Signins', $content, '../', ['scripts' => $scripts]);
