<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $options = [];

    $num_received_contacts = $user->num_received_contacts;
    if ($num_received_contacts) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $title = 'Received Contacts';
        $description = "$num_received_contacts total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'receive');
    }

    if ($user->num_contacts) {
        include_once "$fnsDir/ItemList/escapedPageQuery.php";
        include_once "$fnsDir/Page/imageLink.php";
        $href = "{$base}delete-all/".ItemList\escapedPageQuery();
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Contacts', $href, 'trash-bin')
            .'</div>';
    }

    if ($options) {
        include_once "$fnsDir/create_panel.php";
        $content = join('<div class="hr"></div>', $options);
        return create_panel('Options', $content);
    }

}
