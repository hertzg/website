<?php

namespace ViewFilePage;

function imageOptionsPanel ($file) {

    $fnsDir = __DIR__.'/../../../fns';

    $id = $file->id_files;

    include_once "$fnsDir/Page/imageLink.php";
    $href = "../image/submit-clockwise.php?id=$id";
    $clockwiseLink = \Page\imageLink('Rotate Clockwise', $href, '');

    $title = 'Rotate Count-clockwise';
    $href = "../image/submit-counter-clockwise.php?id=$id";
    $counterClockwiseLink = \Page\imageLink($title, $href, '');

    include_once "$fnsDir/Page/twoColumns.php";
    $content = \Page\twoColumns($clockwiseLink, $counterClockwiseLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Image File Options', $content);

}
