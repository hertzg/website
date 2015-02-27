<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once "$fnsDir/Signins/indexOnUser.php";
include_once '../../lib/mysqli.php';
$signins = Signins\indexOnUser($mysqli, $user->id_users);

$items = [];
include_once "$fnsDir/create_image_text.php";
include_once "$fnsDir/date_ago.php";
foreach ($signins as $signin) {
    $text =
        htmlspecialchars($signin->remote_address)
        .'<div style="color: #777; font-size: 12px; line-height: 14px">'
            .ucfirst(date_ago($signin->insert_time))
        .'</div>';
    $items[] = create_image_text($text, 'sign-in');
}

include_once "$fnsDir/Page/info.php";
$items[] = Page\info('Older data not available');

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

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Successful Signins', $content, $base);
