<?php

include_once 'fns/require_received_bookmarks.php';
$user = require_received_bookmarks();

include_once '../../fns/Users/Bookmarks/Received/clearNumberNew.php';
include_once '../../lib/mysqli.php';
Users\Bookmarks\Received\clearNumberNew($mysqli, $user->id_users);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/received/view/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($mysqli, $user)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Received Bookmarks', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
