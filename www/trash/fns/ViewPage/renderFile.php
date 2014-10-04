<?php

namespace ViewPage;

function renderFile ($id, $file, &$items) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('File name', htmlspecialchars($file->name));

    include_once "$fnsDir/bytestr.php";
    $items[] = \Form\label('Size', bytestr($file->size));

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = \Page\filePreview($file->media_type,
        $file->content_type, $id, '../download-file/', '../../');
    $items[] = \Form\label('Preview', $filePreview);

}
