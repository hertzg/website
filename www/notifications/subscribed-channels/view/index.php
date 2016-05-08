<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['notifications/subscribed-channels/messages']);

$unsubscribeHref = "../unsubscribe/submit.php?id=$id";

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($subscribedChannel, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Other Channel #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var unsubscribeHref = '.json_encode($unsubscribeHref)
        .'</script>'
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
