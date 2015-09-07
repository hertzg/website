<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

unset($_SESSION['account/messages']);

include_once "$fnsDir/Signins/indexPageOnUser.php";
include_once '../../lib/mysqli.php';
$signins = Signins\indexPageOnUser($mysqli,
    $user->id_users, $offset, $limit, $total);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, []);

$items = [];

if ($signins) {

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($signins as $signin) {
        $text =
            htmlspecialchars($signin->remote_address)
            .'<div style="color: #777; font-size: 12px; line-height: 14px">'
                .export_date_ago($signin->insert_time, true)
            .'</div>';
        $items[] = create_image_text($text, 'sign-in');
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
            'title' => 'Account',
            'href' => '../#signins',
        ],
    ],
    'Successful Signins',
    join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Successful Signins', $content, $base, [
    'scripts' => $scripts,
]);
