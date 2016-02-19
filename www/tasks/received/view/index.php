<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['tasks/received/edit-and-import/errors'],
    $_SESSION['tasks/received/edit-and-import/values'],
    $_SESSION['tasks/received/errors'],
    $_SESSION['tasks/received/messages']
);

include_once "$fnsDir/ItemList/Received/itemQuery.php";
$itemQuery = ItemList\Received\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($receivedTask, $user, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Received Task #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
        .'</script>'
        .'<script type="text/javascript" src="../../view.js?1"></script>',
]);
