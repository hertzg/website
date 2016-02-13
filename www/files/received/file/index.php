<?php

include_once 'fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/received/file/rename-and-import/errors'],
    $_SESSION['files/received/file/rename-and-import/values'],
    $_SESSION['files/received/errors'],
    $_SESSION['files/received/messages']
);

include_once "$fnsDir/ItemList/Received/itemQuery.php";
$itemQuery = ItemList\Received\itemQuery($id);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $receivedFile, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Received File #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("delete/submit.php$itemQuery")
        .'</script>'
        .'<script type="text/javascript" src="index.js"></script>',
]);
