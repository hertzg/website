<?php

include_once 'fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $channel);

include_once "$fnsDir/compressed_js_script.php";
$content .=
    compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("delete/submit.php?id=$channel->id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../in-channel.js">'
    .'</script>';

unset(
    $_SESSION['home/messages'],
    $_SESSION['notifications/channels/messages'],
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Notifications', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
