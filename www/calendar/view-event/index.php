<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../';
$fnsDir = '../../fns';

$deleteHref = "../delete-event/submit.php?id=$id";

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($user, $event, $head, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Event #$id", $content, $base, [
    'head' => $head.compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode($deleteHref)
        .'</script>'
        .'<script type="text/javascript" src="../view-event.js?1"></script>',
]);
