<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$items = [];
if ($user->num_api_keys) {

    include_once "$fnsDir/ApiKeys/indexOnUser.php";
    include_once '../../lib/mysqli.php';
    $apiKeys = ApiKeys\indexOnUser($mysqli,
        $user->id_users, $user->api_keys_order_by);

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($apiKeys as $apiKey) {

        $access_time = $apiKey->access_time;
        $descriptions = [];

        $expire_time = $apiKey->expire_time;
        if ($expire_time !== null && $expire_time < $time_today) {
            $descriptions[] = 'Expired.';
        }

        if ($access_time === null) {
            $descriptions[] = 'Never accessed.';
        } else {
            include_once "$fnsDir/export_date_ago.php";
            $descriptions[] = 'Last accessed '
                .export_date_ago($access_time).'.';
        }
        $description = join(' ', $descriptions);

        $title = htmlspecialchars($apiKey->name);
        $id = $apiKey->id;
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, "view/?id=$id", 'api-key', ['id' => $id]);

    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No keys');
}

unset(
    $_SESSION['account/api-keys/new/errors'],
    $_SESSION['account/api-keys/new/values'],
    $_SESSION['account/api-keys/view/messages'],
    $_SESSION['account/messages']
);

include_once 'fns/sort_panel.php';
include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Account',
                'href' => '../#api-keys',
            ],
        ],
        'API Keys',
        Page\sessionErrors('account/api-keys/errors')
        .Page\sessionMessages('account/api-keys/messages')
        .join('<div class="hr"></div>', $items),
        Page\newItemButton('new/', 'API Key')
    )
    .sort_panel($user);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'API Keys', $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
