<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Connections/indexOnUser.php';
include_once '../../lib/mysqli.php';
$connections = Connections\indexOnUser($mysqli, $user->id_users);

$items = [];

if ($connections) {
    include_once '../../fns/Page/imageArrowLink.php';
    foreach ($connections as $connection) {
        $title = htmlspecialchars($connection->username);
        $href = "view/?id=$connection->id";
        $items[] = Page\imageArrowLink($title, $href, 'connection');
    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No connections');
}

include_once '../../fns/Page/imageArrowLinkWithDescription.php';
$title = 'Default Connection';
$description = 'Connection to other users.';
$items[] = Page\imageArrowLinkWithDescription($title,
    $description, 'default/', 'connection');

unset(
    $_SESSION['account/connections/default/messages'],
    $_SESSION['account/connections/new/errors'],
    $_SESSION['account/connections/new/values'],
    $_SESSION['account/connections/view/messages']
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
    'Connections',
    Page\sessionMessages('account/connections/messages')
    .Page\sessionErrors('account/connections/errors')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/', 'New', 'Connection')
);

include_once '../../fns/echo_page.php';
echo echo_page($user, 'Connections', $content, $base);
