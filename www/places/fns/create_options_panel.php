<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $options = [];

    $num_received_places = $user->num_received_places;
    if ($num_received_places) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $options[] = Page\imageArrowLinkWithDescription('Received Places',
            "$num_received_places total.", "{$base}received/",
            'receive', ['id' => 'received']);
    }

    if ($user->num_places) {

        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        $escapedPageQuery = ItemList\escapedPageQuery();

        include_once "$fnsDir/Page/imageArrowLink.php";
        $options[] = Page\imageArrowLink('Map',
            "{$base}map/$escapedPageQuery", 'TODO');

        include_once "$fnsDir/Page/imageLink.php";
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Places',
                    "{$base}delete-all/$escapedPageQuery", 'trash-bin')
            .'</div>';
    }

    if ($options) {
        include_once "$fnsDir/create_panel.php";
        $content = join('<div class="hr"></div>', $options);
        return create_panel('Options', $content);
    }

}
