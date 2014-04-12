<?php

function render_files ($user, array &$items) {

    if (!$user->show_files) return;

    $key = 'files';
    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    $storage_used = $user->storage_used;
    $num_received_files = $user->num_received_files;
    if ($num_received_files || $storage_used) {

        $descriptionItems = [];
        if ($storage_used) {
            include_once '../fns/bytestr.php';
            $descriptionItems[] = bytestr($storage_used).' used.';
        }
        if ($num_received_files) {
            $descriptionItems[] = "$num_received_files received.";
        }
        $description = join(' ', $descriptionItems);

        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
