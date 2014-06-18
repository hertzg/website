<?php

function render_file ($id, $file, &$items) {

    $fnsDir = __DIR__.'/../../../fns';
    $name = $file->name;

    include_once "$fnsDir/Form/label.php";
    $items[] = Form\label('File name', htmlspecialchars($name));

    include_once "$fnsDir/bytestr.php";
    $items[] = Form\label('Size', bytestr($file->size));

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = Page\filePreview($name, $id, '../download-file/');
    $items[] = Form\label('Preview', $filePreview);

}
