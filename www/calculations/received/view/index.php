<?php

include_once '../fns/require_received_calculation.php';
include_once '../../../lib/mysqli.php';
list($receivedCalculation, $id, $user) = require_received_calculation(
    $mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['calculations/received/edit-and-import/errors'],
    $_SESSION['calculations/received/edit-and-import/values'],
    $_SESSION['calculations/received/errors'],
    $_SESSION['calculations/received/messages']
);

include_once "$fnsDir/ItemList/Received/itemQuery.php";
$itemQuery = ItemList\Received\itemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($receivedCalculation, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../../view.js">'
    .'</script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Received Calculation #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);