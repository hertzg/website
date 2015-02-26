<?php

include_once 'fns/require_received_files.php';
$user = require_received_files();
$id_users = $user->id_users;

$base = '../../';
$fnsDir = '../../fns';

include_once '../../lib/mysqli.php';

if ($user->home_num_new_received_folders) {
    include_once "$fnsDir/Users/Folders/Received/clearNumberNew.php";
    Users\Folders\Received\clearNumberNew($mysqli, $id_users);
}

if ($user->home_num_new_received_files) {
    include_once "$fnsDir/Users/Files/Received/clearNumberNew.php";
    Users\Files\Received\clearNumberNew($mysqli, $id_users);
}

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/received/file/messages'],
    $_SESSION['files/received/folder/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($mysqli, $user)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Received Files', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
