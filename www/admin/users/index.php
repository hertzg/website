<?php

include_once '../fns/require_admin.php';
require_admin();

unset($_SESSION['admin/messages']);

include_once '../../fns/Users/index.php';
include_once '../../lib/mysqli.php';
$users = Users\index($mysqli);

$items = [];
if ($users) {
    include_once '../../fns/Page/imageArrowLink.php';
    foreach ($users as $user) {
        $items[] = Page\imageArrowLink(htmlspecialchars($user->username),
            "view/?id=$user->id_users", 'user');
    }
} else {
    $items[] = Page\info('No users');
}

include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#users',
        ],
    ],
    'Users',
    join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_guest_page.php';
echo_guest_page('Set New Username/Password', $content, '../../');
