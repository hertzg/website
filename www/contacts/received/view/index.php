<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['contacts/received/edit-and-import/errors'],
    $_SESSION['contacts/received/edit-and-import/values'],
    $_SESSION['contacts/received/messages']
);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($receivedContact, $head, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer"'
    .' src="../../view.js"></script>';

if ($receivedContact->timezone !== null) {
    $scripts .= compressed_js_script('timezoneLabel', $base);
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Contact #$id", $content, $base, [
    'head' => $head
        .compressed_css_link('contact', $base)
        .compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
