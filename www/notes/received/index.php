<?php

include_once 'fns/require_received_notes.php';
$user = require_received_notes();

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Users/Notes/Received/clearNumberNew.php";
include_once '../../lib/mysqli.php';
Users\Notes\Received\clearNumberNew($mysqli, $user->id_users);

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/received/view/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($mysqli, $user)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Received Notes', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
