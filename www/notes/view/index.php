<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($note, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" src="../view.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Note #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
