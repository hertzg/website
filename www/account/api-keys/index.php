<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$items = [];
if ($user->num_api_keys) {

    include_once '../../fns/ApiKeys/indexOnUser.php';
    include_once '../../lib/mysqli.php';
    $apiKeys = ApiKeys\indexOnUser($mysqli, $user->id_users);

    include_once '../../fns/user_time_today.php';
    $time_today = user_time_today($user);

    include_once '../../fns/Page/imageArrowLinkWithDescription.php';
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
            include_once '../../fns/date_ago.php';
            $descriptions[] = 'Last accessed '.date_ago($access_time).'.';
        }
        $description = join(' ', $descriptions);

        $title = htmlspecialchars($apiKey->name);
        $id = $apiKey->id;
        $options = ['id' => "api_key_$id"];
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, "view/?id=$id", 'api-key', $options);

    }

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No keys');
}

unset(
    $_SESSION['account/api-keys/new/errors'],
    $_SESSION['account/api-keys/new/values'],
    $_SESSION['account/api-keys/view/messages'],
    $_SESSION['account/messages']
);

include_once '../../fns/Page/newItemButton.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '..',
        ],
    ],
    'API Keys',
    Page\sessionErrors('account/api-keys/errors')
    .Page\sessionMessages('account/api-keys/messages')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/', 'API Key')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'API Keys', $content, $base);
