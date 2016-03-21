<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/itemQuery.php";
$deleteHref = "../delete-point/submit.php".ItemList\itemQuery($id);

include_once '../fns/ViewPointPage/create.php';
$content = ViewPointPage\create($point, $scripts);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Point #$id", $content, $base, [
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode($deleteHref)
        .'</script>'
        .'<script type="text/javascript" src="../view-point.js?1"></script>',
]);
