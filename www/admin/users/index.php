<?php

include_once '../fns/require_admin.php';
require_admin();

unset(
    $_SESSION['admin/messages'],
    $_SESSION['admin/users/new/errors'],
    $_SESSION['admin/users/new/values'],
    $_SESSION['admin/users/view/messages']
);

$fnsDir = '../../fns';

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/Users/indexPage.php";
include_once '../../lib/mysqli.php';
$users = Users\indexPage($mysqli, $offset, $limit, $total);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

$items = [];

if ($users) {

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items);

    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($users as $user) {
        $id = $user->id_users;
        $items[] = Page\imageArrowLink(htmlspecialchars($user->username),
            "view/?id=$id", 'user', ['id' => $id]);
    }

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items);

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

include_once '../fns/echo_admin_page.php';
echo_admin_page('Users', $content, '../');
