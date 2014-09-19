<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['schedules/edit/errors'],
    $_SESSION['schedules/edit/values'],
    $_SESSION['schedules/errors'],
    $_SESSION['schedules/messages']
);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/create_view_page.php';
$content =
    create_view_page($schedule)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, "Schedule #$id", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
