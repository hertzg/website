<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

unset(
    $_SESSION['notes/edit/errors'],
    $_SESSION['notes/edit/values'],
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/send/errors'],
    $_SESSION['notes/send/messages'],
    $_SESSION['notes/send/values']
);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($mysqli, $user, $note)
    .'<script type="text/javascript" defer="defer"'
    .' src="../../js/confirmDialog.js"></script>'
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once '../../fns/echo_page.php';
echo_page($user, "Note #$id", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
