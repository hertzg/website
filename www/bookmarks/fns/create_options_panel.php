<?php

function create_options_panel ($user, $base = '') {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    $title = 'New Bookmark';
    $href = "{$base}new/";
    $options = [Page\imageArrowLink($title, $href, 'create-bookmark')];

    if ($user->num_bookmarks) {
        $title = 'Delete All Bookmarks';
        $href = "{$base}delete-all/";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    $num_received_bookmarks = $user->num_received_bookmarks;
    if ($num_received_bookmarks) {
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $title = 'Received Bookmarks';
        $description = "$num_received_bookmarks total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'TODO');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
