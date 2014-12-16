<?php

namespace ViewFilePage;

function imageOptionsPanel ($file) {

    $fnsDir = __DIR__.'/../../../fns';

    $id = $file->id_files;

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $href = "../image/submit-rotate-cw.php?id=$id";
    $rotateCwLink = \Page\imageLinkWithDescription(
        'Rotate CW', 'Rotate clockwise', $href, 'TODO');

    $href = "../image/submit-rotate-ccw.php?id=$id";
    $rotateCcwLink = \Page\imageLinkWithDescription(
        'Rotate CCW', 'Rotate counterclockwise', $href, 'TODO');

    include_once "$fnsDir/Page/twoColumns.php";
    $content = \Page\twoColumns($rotateCwLink, $rotateCcwLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Image File Options', $content);

}
