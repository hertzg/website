<?php

include_once 'fns/require_received_places.php';
$user = require_received_places();

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Users/Places/Received/clearNumberNew.php";
include_once '../../lib/mysqli.php';
Users\Places\Received\clearNumberNew($mysqli, $user->id_users);

unset(
    $_SESSION['places/errors'],
    $_SESSION['places/messages'],
    $_SESSION['places/received/view/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($mysqli, $user)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Received Places', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
