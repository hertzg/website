<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['calendar/edit-event/errors'],
    $_SESSION['calendar/edit-event/values'],
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/create_view_page.php';
$content =
    create_view_page($event)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Event #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
