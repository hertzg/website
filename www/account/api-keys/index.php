<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/ApiKeys/indexOnUser.php';
include_once '../../lib/mysqli.php';
$apiKeys = ApiKeys\indexOnUser($mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';

$items = [];
if ($apiKeys) {
    foreach ($apiKeys as $apiKey) {
        $title = htmlspecialchars($apiKey->name);
        $href = "view/?id=$apiKey->id";
        $items[] = Page\imageArrowLink($title, $href, 'api-key');
    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No keys');
}

$newLink = Page\imageArrowLink('New Key', 'new/', 'create-api-key');

unset(
    $_SESSION['account/api-keys/new/errors'],
    $_SESSION['account/api-keys/new/values'],
    $_SESSION['account/api-keys/view/messages'],
    $_SESSION['account/messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Account',
            'href' => '..',
        ],
    ],
    'API Keys',
    Page\sessionErrors('account/api-keys/errors')
    .Page\sessionMessages('account/api-keys/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $newLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'API Keys', $content, $base);
