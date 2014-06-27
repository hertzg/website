<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "{$base}new/$escapedPageQuery";
    $options = [Page\imageArrowLink('New Note', $href, 'create-note')];

    $num_received_notes = $user->num_received_notes;
    if ($num_received_notes) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $title = 'Received Notes';
        $description = "$num_received_notes total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'receive');
    }

    if ($user->num_notes) {
        $title = 'Delete All Notes';
        $href = "{$base}delete-all/$escapedPageQuery";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
