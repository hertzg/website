<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

unset(
    $_SESSION['admin/messages'],
    $_SESSION['admin/users/new/errors'],
    $_SESSION['admin/users/new/values'],
    $_SESSION['admin/users/view/messages']
);

include_once "$fnsDir/Users/index.php";
include_once '../../lib/mysqli.php';
$users = Users\index($mysqli);

$items = [];
if ($users) {
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($users as $user) {
        $id = $user->id_users;
        $items[] = Page\imageArrowLink(htmlspecialchars($user->username),
            "view/?id=$id", 'user', ['id' => $id]);
    }
} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No users');
}

include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#users',
        ],
    ],
    'Users',
    Page\sessionErrors('admin/users/errors')
    .Page\sessionMessages('admin/users/messages')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/', 'User')
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('Users', $content, '../../');
