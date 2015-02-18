<?php

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['calendar/all-events/edit/errors'],
    $_SESSION['calendar/all-events/edit/values'],
    $_SESSION['calendar/all-events/errors'],
    $_SESSION['calendar/all-events/messages']
);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_view_page($user, $event)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Event #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);