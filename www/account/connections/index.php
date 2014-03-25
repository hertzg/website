<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Page/imageArrowLink.php';
$options = array(
    Page\imageArrowLink('New Connection', 'new/', 'TODO')
);

unset(
    $_SESSION['account/connections/index_errors'],
    $_SESSION['account/connections/index_lastpost']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/info.php';
include_once '../../fns/Page/sessionMessages.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ),
        array(
            'title' => 'Account',
            'href' => '..',
        ),
    ),
    'Manage Connections',
    Page\sessionMessages('account/connections/index_messages')
    .Page\info('No connections.')
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../fns/echo_page.php';
echo echo_page($user, 'Connections', $content, $base);
