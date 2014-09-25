<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['notifications/subscribed-channels/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($subscribedChannel)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var unsubscribeHref = '.json_encode("../unsubscribe/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Other Channel #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
