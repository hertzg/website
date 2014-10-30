<?php

$base = '../';

include_once '../fns/simple_require_user.php';
$user = simple_require_user($base);

unset($_SESSION['home/messages']);

include_once '../fns/HomePage/create.php';
include_once '../lib/mysqli.php';
$content = HomePage\create($mysqli, $user);

include_once '../fns/Page/confirmDialog.php';
$content .= Page\confirmDialog('Are you sure you want to sign out?',
    'Yes, sign out', 'submit.php', '../home/');

include_once '../fns/compressed_css_link.php';
$head = compressed_css_link('confirmDialog', $base);

include_once '../fns/echo_page.php';
echo_page($user, 'Sign Out?', $content, $base, ['head' => $head]);
