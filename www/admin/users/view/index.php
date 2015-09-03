<?php

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content = create_view_page($user, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" src="index.js"></script>';

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page("User #$id", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
