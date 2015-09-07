<?php

include_once 'fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $channel, $scripts, $notifications);

if ($notifications) {
    include_once "$fnsDir/compressed_js_script.php";
    $content .=
        compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteAllHref = '.json_encode("delete-all/submit.php?id=$id")
        .'</script>'
        .'<script type="text/javascript"'
        .' defer="defer" src="../in-channel.js?2">'
        .'</script>';
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Notifications', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
