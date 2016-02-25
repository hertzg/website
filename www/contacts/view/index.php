<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($user, $contact, $head, $scripts);

include_once "$fnsDir/compressed_js_script.php";
$scripts .= compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" src="../view.js?1"></script>';

if ($contact->photo_id) {
    $deletePhotoHref = "../photo/delete/submit.php?id=$id";
    $scripts .=
        '<script type="text/javascript">'
            .'var deletePhotoHref = '.json_encode($deletePhotoHref)
        .'</script>'
        .'<script type="text/javascript" src="index.js"></script>';
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Contact #$id", $content, $base, [
    'head' => $head.compressed_css_link('contact', $base)
        .compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
