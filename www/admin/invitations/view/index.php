<?php

include_once '../fns/require_invitation.php';
include_once '../../../lib/mysqli.php';
list($invitation, $id, $admin_user) = require_invitation($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
$content = create_view_page($invitation, $scripts);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, "Invitation #$id", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
        .'</script>'
        .'<script type="text/javascript" src="index.js"></script>',
]);
