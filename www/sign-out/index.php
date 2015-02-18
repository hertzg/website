<?php

$base = '../';

include_once '../fns/simple_require_user.php';
$user = simple_require_user($base);

unset($_SESSION['home/messages']);

include_once '../fns/HomePage/create.php';
include_once '../lib/mysqli.php';
$content = HomePage\create($mysqli, $user, $head);

include_once '../fns/get_sign_out_timeout.php';
$timeout = get_sign_out_timeout();

include_once '../fns/Page/confirmDialog.php';
$content .= Page\confirmDialog(
    'Are you sure you want to sign out?'
    ." It will automatically sign out in $timeout seconds.",
    'Yes, sign out', 'submit.php', '../home/');

include_once '../fns/compressed_css_link.php';
$head .=
    compressed_css_link('confirmDialog', $base)
    ."<meta http-equiv=\"Refresh\" content=\"$timeout; url=submit.php\" />";

include_once '../fns/echo_page.php';
echo_page($user, 'Sign Out?', $content, $base, ['head' => $head]);
