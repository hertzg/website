<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/ApiKeys/indexOnUser.php';
include_once '../../lib/mysqli.php';
$apiKeys = ApiKeys\indexOnUser($mysqli, $user->id_users);

$items = [];
if ($apiKeys) {
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No keys');
}

include_once '../../fns/Page/imageArrowLink.php';
$newLink = Page\imageArrowLink('New Key', 'new/', 'TODO');

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
$content = create_tabs(
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
    join('<div class="hr"></div>', $items)
    .create_panel('Options', $newLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'API Keys', $content, $base);
