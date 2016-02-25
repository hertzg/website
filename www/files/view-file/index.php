<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/ViewFilePage/create.php';
$content = ViewFilePage\create($mysqli, $file, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "File #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete-file/submit.php?id=$id")
        .'</script>'
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
