<?php

namespace HomePage;

function renderFiles ($user, &$items) {

    if (!$user->show_files) return;

    $fnsDir = __DIR__.'/..';

    $storage_used = $user->storage_used;
    $num_received_files = $user->num_received_files;
    $num_received_folders = $user->num_received_folders;

    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    $options = ['id' => 'files'];
    if ($num_received_files || $num_received_folders || $storage_used) {

        $descriptionItems = [];
        if ($storage_used) {
            include_once "$fnsDir/bytestr.php";
            $descriptionItems[] = bytestr($storage_used).' used.';
        }
        if ($num_received_files || $num_received_folders) {
            $n = $num_received_files + $num_received_folders;
            $descriptionItems[] = "$n received.";
        }
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['files'] = $link;

}
