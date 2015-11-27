<?php

namespace HomePage;

function renderFiles ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_upload_files) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['upload-files'] = \Page\thumbnailLink(
            'Upload Files', '../files/upload-files/', 'upload');
    }

    if (!$user->show_files) return;

    $storage_used = $user->storage_used;
    $num_received_files = $user->num_received_files;
    $num_received_folders = $user->num_received_folders;

    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    $options = ['id' => 'files'];
    if ($num_received_files || $num_received_folders || $storage_used) {

        $descriptions = [];
        if ($storage_used) {
            include_once "$fnsDir/bytestr.php";
            $descriptions[] = bytestr($storage_used).' used.';
        }
        if ($num_received_files || $num_received_folders) {
            $n = $num_received_files + $num_received_folders;
            $descriptions[] = "$n received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['files'] = $link;

}
