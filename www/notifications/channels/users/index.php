<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['notifications/channels/users/add/errors'],
    $_SESSION['notifications/channels/users/add/values'],
    $_SESSION['notifications/channels/view/messages']
);

include_once 'fns/create_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_page($mysqli, $id)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var channelName = '.json_encode($channel->channel_name)
    .'</script>'
    .'<script type="text/javascript" src="index.js?1"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Channel #$id Users", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
