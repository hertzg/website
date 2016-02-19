<?php

include_once '../fns/require_received_schedule.php';
include_once '../../../lib/mysqli.php';
list($receivedSchedule, $id, $user) = require_received_schedule($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['schedules/received/edit-and-import/errors'],
    $_SESSION['schedules/received/edit-and-import/values'],
    $_SESSION['schedules/received/errors'],
    $_SESSION['schedules/received/messages']
);

include_once "$fnsDir/ItemList/Received/itemQuery.php";
$itemQuery = ItemList\Received\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($user, $receivedSchedule, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Received Schedule #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
        .'</script>'
        .'<script type="text/javascript" src="../../view.js?1"></script>',
]);
