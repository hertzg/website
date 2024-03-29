<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_user_with_password.php';
$user = require_user_with_password('../');

$base = '../../';
$fnsDir = '../../fns';

$items = [];

if ($user->num_connections) {

    include_once "$fnsDir/Connections/indexOnUser.php";
    include_once '../../lib/mysqli.php';
    $connections = Connections\indexOnUser($mysqli, $user->id_users);

    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($connections as $connection) {
        $id = $connection->id;
        $address = $connection->address;
        $title = htmlspecialchars($connection->username);
        if ($address !== null) $title .= '@'.htmlspecialchars($address);
        $items[] = Page\imageArrowLink($title,
            "view/?id=$id", 'connection', ['id' => $id]);
    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No connections');
}

include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
$items[] = Page\imageArrowLinkWithDescription(
    'Default Connection', 'Connection to other users.',
    'default/', 'connection', ['id' => 'default']);

unset(
    $_SESSION['account/connections/default/messages'],
    $_SESSION['account/connections/new/errors'],
    $_SESSION['account/connections/new/values'],
    $_SESSION['account/connections/view/messages']
);

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\create(
    [
        'title' => 'Account',
        'href' => '../#connections',
    ],
    'Connections',
    Page\sessionMessages('account/connections/messages')
    .Page\sessionErrors('account/connections/errors')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/', 'Connection', !$user->num_connections)
);

include_once "$fnsDir/echo_user_page.php";
echo echo_user_page($user, 'Connections', $content, $base);
