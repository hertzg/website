<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/received/errors'],
    $_SESSION['files/received/messages'],
    $_SESSION['files/received/folder/rename-and-import/errors'],
    $_SESSION['files/received/folder/rename-and-import/values']
);

include_once "$fnsDir/ItemList/Received/itemQuery.php";
$itemQuery = ItemList\Received\itemQuery($id);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $receivedFolder, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Received Folder #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("delete/submit.php$itemQuery")
        .'</script>'
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
