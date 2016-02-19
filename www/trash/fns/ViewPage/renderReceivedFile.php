<?php

namespace ViewPage;

function renderReceivedFile ($mysqli, $deletedItem, &$items, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/DeletedItems/ensureReceivedFileSums.php";
    \DeletedItems\ensureReceivedFileSums($mysqli, $deletedItem);

    $file = json_decode($deletedItem->data_json);

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('File name', htmlspecialchars($file->name));

    $items[] = \Form\label('Size', $file->readable_size);

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    $path = \ReceivedFiles\File\path($deletedItem->id_users, $file->id);

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = \Page\filePreview($file->media_type,
        $file->content_type, $deletedItem->id, $path,
        '../download-file/', '../../', $scripts);
    $items[] = \Form\label('Preview', $filePreview);

    $items[] = \Form\label('MD5 sum', $file->md5_sum);
    $items[] = \Form\label('SHA-256 sum', $file->sha256_sum);

}
