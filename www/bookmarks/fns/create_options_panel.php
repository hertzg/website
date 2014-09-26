<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $options = [];

    $num_received_bookmarks = $user->num_received_bookmarks;
    if ($num_received_bookmarks) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $title = 'Received Bookmarks';
        $description = "$num_received_bookmarks total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'receive');
    }

    if ($user->num_bookmarks) {
        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        include_once "$fnsDir/Page/imageArrowLink.php";
        $title = 'Delete All Bookmarks';
        $href = "{$base}delete-all/".ItemList\escapedPageQuery();
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageArrowLink($title, $href, 'trash-bin')
            .'</div>';
    }

    if ($options) {
        include_once "$fnsDir/create_panel.php";
        $content = join('<div class="hr"></div>', $options);
        return create_panel('Options', $content);
    }

}
