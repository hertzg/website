<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $options = [];

    $num_received_notes = $user->num_received_notes;
    if ($num_received_notes) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $options[] = Page\imageArrowLinkWithDescription('Received Notes',
            "$num_received_notes total.", "{$base}received/",
            'receive', ['id' => 'received']);
    }

    if ($user->num_notes) {
        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        include_once "$fnsDir/Page/imageLink.php";
        $href = "{$base}delete-all/".ItemList\escapedPageQuery();
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Notes', $href, 'trash-bin')
            .'</div>';
    }

    if ($options) {
        include_once "$fnsDir/create_panel.php";
        $content = join('<div class="hr"></div>', $options);
        return create_panel('Options', $content);
    }

}
