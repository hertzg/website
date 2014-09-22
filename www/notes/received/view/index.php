<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['notes/received/edit-and-import/errors'],
    $_SESSION['notes/received/edit-and-import/values'],
    $_SESSION['notes/received/messages']
);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($receivedNote)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../../view.js">'
    .'</script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Note #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
