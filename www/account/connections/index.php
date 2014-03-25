<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';
$options = [
    Page\imageArrowLink('New Connection', 'new/', 'create-connection'),
    Page\imageArrowLinkWithDescription('Default Connection',
        'Other users', 'default/', 'connection'),
];

include_once '../../fns/Connections/indexOnUser.php';
include_once '../../lib/mysqli.php';
$connections = Connections\indexOnUser($mysqli, $user->idusers);

$items = [];

if ($items) {
    foreach ($connections as $connection) {
        $title = htmlspecialchars($connection->username);
        $items[] = Page\imageArrowLink($title, "view/?id=$connection->id", 'connection');
    }
    $items[] = Page\imageArrowLink('Other users', 'other/', 'connection');
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No connections');
}

unset(
    $_SESSION['account/connections/default/messages'],
    $_SESSION['account/connections/new/errors'],
    $_SESSION['account/connections/new/values'],
    $_SESSION['account/connections/view/messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
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
    'Connections',
    Page\sessionMessages('account/connections/messages')
    .Page\sessionErrors('account/connections/errors')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../fns/echo_page.php';
echo echo_page($user, 'Connections', $content, $base);
