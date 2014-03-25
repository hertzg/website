<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Page/imageArrowLink.php';
$options = [Page\imageArrowLink('New Connection', 'new/', 'TODO')];

include_once '../../fns/Connections/indexOnUser.php';
include_once '../../lib/mysqli.php';
$connections = Connections\indexOnUser($mysqli, $user->idusers);

$items = [];

foreach ($connections as $connection) {
    $title = htmlspecialchars($connection->username);
    $items[] = Page\imageArrowLink($title, "view/?id=$connection->id", 'TODO');
}

unset(
    $_SESSION['account/connections/new/index_errors'],
    $_SESSION['account/connections/new/index_values']
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
    Page\sessionMessages('account/connections/index_messages')
    .Page\sessionErrors('account/connections/index_errors')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../fns/echo_page.php';
echo echo_page($user, 'Connections', $content, $base);
