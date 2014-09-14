<?php

function render_files ($user, &$items) {

    if (!$user->show_files) return;

    $fnsPageDir = __DIR__.'/../../fns/Page';

    $storage_used = $user->storage_used;
    $num_received_files = $user->num_received_files;
    $num_received_folders = $user->num_received_folders;

    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    if ($num_received_files || $num_received_folders || $storage_used) {

        $descriptionItems = [];
        if ($storage_used) {
            include_once __DIR__.'/../../fns/bytestr.php';
            $descriptionItems[] = bytestr($storage_used).' used.';
        }
        if ($num_received_files || $num_received_folders) {
            $n = $num_received_files + $num_received_folders;
            $descriptionItems[] = "$n received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        $link = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once "$fnsPageDir/imageArrowLink.php";
        $link = Page\imageArrowLink($title, $href, $icon);
    }

    $items['files'] = $link;

}
