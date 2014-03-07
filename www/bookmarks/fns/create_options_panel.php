<?php

function create_options_panel ($user, $base = '') {

    $title = 'New Bookmark';
    $href = "{$base}new/";
    $options = array(Page::imageArrowLink($title, $href, 'create-bookmark'));

    if ($user->num_bookmarks) {
        $title = 'Delete All Bookmarks';
        $href = "{$base}delete-all/";
        $options[] = Page::imageArrowLink($title, $href, 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
