<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['contacts/edit/errors'],
    $_SESSION['contacts/edit/values'],
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/photo/edit/errors'],
    $_SESSION['contacts/send/errors'],
    $_SESSION['contacts/send/messages'],
    $_SESSION['contacts/send/values']
);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($contact)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../view.js"></script>';

if ($contact->timezone !== null) {
    $content .= compressed_js_script('timezoneLabel', $base);
}

if ($contact->photo_id) {
    $deletePhotoHref = "../photo/delete/submit.php?id=$id";
    $content .=
        '<script type="text/javascript">'
            .'var deletePhotoHref = '.json_encode($deletePhotoHref)
        .'</script>'
        .'<script type="text/javascript" defer="defere" src="index.js">'
        .'</script>';
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Contact #$id", $content, $base, [
    'head' => compressed_css_link('contact', $base)
        .compressed_css_link('confirmDialog', $base),
]);
