<?php

include_once 'fns/require_optional_folder.php';
include_once '../lib/mysqli.php';
list($user, $folder, $id) = require_optional_folder($mysqli, './');

$base = '../';
$fnsDir = '../fns';

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $folder, $scripts, $title);

if ($id) {
    $deleteHref = "delete-folder/submit.php?id_folders=$id";
    include_once "$fnsDir/compressed_js_script.php";
    $content .=
        compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode($deleteHref)
        .'</script>'
        .'<script type="text/javascript" src="index.js"></script>';
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
