<?php

function render_files ($user, array &$items) {
    $title = 'Files';
    $href = '../files/';
    $icon = 'files';
    if ($user->storageused) {
        include_once '../fns/bytestr.php';
        $description = bytestr($user->storageused).' used.';
        $items[] = Page::imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    } else {
        $items[] = Page::imageArrowLink($title, $href, $icon);
    }
}
