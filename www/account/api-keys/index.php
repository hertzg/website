<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

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

$items = [];
if ($apiKeys) {

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($apiKeys as $apiKey) {

        $access_time = $apiKey->access_time;
        $descriptions = [];

        $expire_time = $apiKey->expire_time;
        if ($expire_time !== null && $expire_time < $time_today) {
            $descriptions[] = 'Expired.';
        }

        if ($access_time === null) $descriptions[] = 'Never accessed.';
        else {
            include_once "$fnsDir/export_date_ago.php";
            $descriptions[] = 'Last accessed '
                .export_date_ago($access_time).'.';
        }
        $description = join(' ', $descriptions);

        $id = $apiKey->id;
        $items[] = Page\imageArrowLinkWithDescription(
            htmlspecialchars($apiKey->name), $description,
            'view/'.ItemList\escapedItemQuery($id), 'api-key', ['id' => $id]);

    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

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
include_once "$fnsDir/ItemList/escapedPageQuery.php";
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
        Page\newItemButton('new/'.ItemList\escapedPageQuery(), 'API Key')
    )
    .sort_panel($user);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'API Keys', $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
