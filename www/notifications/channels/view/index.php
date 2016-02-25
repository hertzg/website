<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($channel, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Channel #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
        .'</script>'
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
