<?php

function render_files ($user, array &$items) {

    if (!$user->show_files) return;

    $key = 'files';
    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    if ($user->storageused) {

        include_once '../fns/bytestr.php';
        $description = bytestr($user->storageused).' used.';

        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $items[$key] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    } else {
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items[$key] = Page\imageArrowLink($title, $href, $icon);
    }

}
