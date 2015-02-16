<?php

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['places/edit/errors'],
    $_SESSION['places/edit/values'],
    $_SESSION['places/errors'],
    $_SESSION['places/messages'],
    $_SESSION['places/send/errors'],
    $_SESSION['places/send/messages'],
    $_SESSION['places/send/values']
);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($mysqli, $place)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../view.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Place #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
