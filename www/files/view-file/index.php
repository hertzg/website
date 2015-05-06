<?php

include_once '../fns/ViewFilePage/create.php';
include_once '../../lib/mysqli.php';
$content = ViewFilePage\create($mysqli, $user, $file, $scripts);
$id = $file->id_files;

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/compressed_js_script.php";
$content .=
    compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete-file/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "File #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
