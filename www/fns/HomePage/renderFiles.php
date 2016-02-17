<?php

namespace HomePage;

function renderFiles ($user) {

    $fnsDir = __DIR__.'/..';

    $storage_used = $user->storage_used;
    $num_new_received = $user->num_received_files +
        $user->num_received_folders - $user->num_archived_received_files -
        $user->num_archived_received_folders;

    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    $options = ['id' => 'files'];
    if ($num_new_received || $storage_used) {

        $descriptions = [];
        if ($storage_used) {
            include_once "$fnsDir/bytestr.php";
            $descriptions[] = bytestr($storage_used, '&nbsp;').'&nbsp;used.';
        }
        if ($num_new_received) {
            $descriptions[] = "$num_new_received&nbsp;new&nbsp;received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription($title,
            $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
